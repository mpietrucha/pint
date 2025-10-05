<?php

namespace Mpietrucha\Pint\Environment\Config;

use Mpietrucha\Utility\Concerns\Compatible;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CompatibleInterface;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Str;
use Mpietrucha\Utility\Type;

class Filter implements CompatibleInterface, CreatableInterface
{
    use Compatible, Creatable;

    public function __construct(protected string $path)
    {
    }

    public function __invoke(mixed $value): bool
    {
        return static::compatible($value) && $this->get($value);
    }

    public function get(string $value): bool
    {
        return Str::is($value, $path = $this->path()) || Str::contains($path, $value);
    }

    protected function path(): string
    {
        return $this->path;
    }

    protected static function compatibility(mixed $value): bool
    {
        return Type::string($value);
    }
}
