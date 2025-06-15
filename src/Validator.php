<?php

namespace Mpietrucha\Zed\Pint;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Mpietrucha\Zed\Pint\Contracts\ConfigInterface;
use Mpietrucha\Zed\Pint\Contracts\EnvironmentInterface;
use Mpietrucha\Zed\Pint\Contracts\ValidatorInterface;

class Validator implements ValidatorInterface
{
    /**
     * @param  string[]  $excluded
     */
    public function __construct(protected array $excluded, protected ?string $file = null)
    {
    }

    public static function build(ConfigInterface $config, EnvironmentInterface $environment): self
    {
        $excluded = $config->excluded();

        $file = $environment->file();

        return new self($excluded, $file);
    }

    public function validated(): bool
    {
        return Collection::make($this->excluded())->filter($this->filter(...))->isEmpty();
    }

    protected function filter(mixed $exclude): bool
    {
        $file = $this->file();

        if ($file === null || is_string($exclude) === false) {
            return true;
        }

        return Str::is($exclude, $file) || Str::contains($file, $exclude);
    }

    /**
     * @return string[]
     */
    protected function excluded(): array
    {
        return $this->excluded;
    }

    protected function file(): ?string
    {
        return $this->file;
    }
}
