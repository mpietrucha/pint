<?php

namespace Mpietrucha\Pint\Environment;

use Mpietrucha\Pint\Contracts\ConfigInterface;
use Mpietrucha\Pint\Environment\Config\Excluded;
use Mpietrucha\Pint\Environment\Config\File;
use Mpietrucha\Pint\Exception\ConfigFileException;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Concerns\Arrayable;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Normalizer;

class Config implements ConfigInterface, CreatableInterface
{
    use Arrayable, Creatable;

    /**
     * @var \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, mixed>|null
     */
    protected ?EnumerableInterface $config = null;

    /**
     * @var \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, mixed>|null
     */
    protected ?EnumerableInterface $excludes = null;

    public function __construct(protected string $file)
    {
        if (Filesystem::exists($file)) {
            return;
        }

        ConfigFileException::for($file)->throw();
    }

    public static function find(): static
    {
        return File::find() |> static::create(...);
    }

    public function file(): string
    {
        return $this->file;
    }

    public function toArray(): array
    {
        return ['--config', $this->file()];
    }

    public function get(): EnumerableInterface
    {
        return $this->config ??= $this->file() |> Filesystem::json(...) |> Collection::create(...);
    }

    public function excludes(): EnumerableInterface
    {
        /** @phpstan-ignore-next-line argument.type */
        return $this->excludes ??= $this->get()->only([
            'notName',
            'exclude',
            'notPath',
        ])->flatten();
    }

    public function excluded(string $path): bool
    {
        return Excluded::create($path) |> $this->excludes()->first(...) |> Normalizer::boolean(...);
    }

    final public function included(string $path): bool
    {
        return $this->excluded($path) |> Normalizer::not(...);
    }
}
