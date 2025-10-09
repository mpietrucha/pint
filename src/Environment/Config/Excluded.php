<?php

namespace Mpietrucha\Pint\Environment\Config;

use Mpietrucha\Pint\Concerns\InteractsWithPath;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CompatibleInterface;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Str;

class Excluded implements CompatibleInterface, CreatableInterface
{
    use Creatable, InteractsWithPath;

    public function __construct(protected string $value)
    {
    }

    public function __invoke(mixed $value): bool
    {
        return static::compatible($value) && $this->get($value);
    }

    public function is(string $value): bool
    {
        return Str::is($value, $this->value());
    }

    public function contains(string $value): bool
    {
        return Str::contains($this->value(), $value);
    }

    public function get(string $value): bool
    {
        return $this->is($value) || $this->contains($value);
    }

    protected function value(): string
    {
        return $this->value;
    }
}
