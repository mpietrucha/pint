<?php

namespace Mpietrucha\Pint\Environment\Argv;

use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Concerns\Compatible;
use Mpietrucha\Utility\Contracts\CompatibleInterface;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Type;

abstract class Path implements CompatibleInterface
{
    use Compatible;

    /**
     * @param  array<int, mixed>  $argv
     */
    public static function get(array $argv): ?string
    {
        $candidates = [Arr::first($argv), Arr::last($argv)];

        return Arr::first([
            Arr::last($argv),
            Arr::first($argv),
        ], static::compatible(...));
    }

    protected static function compatibility(mixed $path): bool
    {
        return Type::string($path) && Filesystem::exists($path);
    }
}
