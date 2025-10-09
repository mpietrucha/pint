<?php

namespace Mpietrucha\Pint\Environment\Argv;

use Mpietrucha\Pint\Concerns\InteractsWithPath;
use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Concerns\Passable;
use Mpietrucha\Utility\Contracts\CompatibleInterface;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Contracts\PassableInterface;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Normalizer;

class Path implements CompatibleInterface, CreatableInterface, PassableInterface
{
    use Creatable, InteractsWithPath, Passable;

    /**
     * @var array<int, string>
     */
    protected static array $excludes = [
        '--config',
        '--cache-file',
        '--output-to-file',
    ];

    protected ?string $previous = null;

    public function __invoke(mixed $value): bool
    {
        if (static::incompatible($value)) {
            return false;
        }

        return $this->get($value, $this->record($value));
    }

    public function get(string $value, ?string $previous = null): bool
    {
        return $this->included($previous) && Filesystem::exists($value);
    }

    public function excluded(mixed $value): bool
    {
        return Arr::contains(static::excludes(), $value);
    }

    final public function included(mixed $value): bool
    {
        return $this->excluded($value) |> Normalizer::not(...);
    }

    protected function record(string $value): ?string
    {
        $previous = $this->previous();

        return $this->pass($previous)->remember($value);
    }

    protected function remember(string $previous): void
    {
        $this->previous = $previous;
    }

    protected function previous(): ?string
    {
        return $this->previous;
    }

    /**
     * @return array<int, string>
     */
    protected static function excludes(): array
    {
        return static::$excludes;
    }
}
