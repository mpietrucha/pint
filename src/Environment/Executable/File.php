<?php

namespace Mpietrucha\Pint\Environment\Executable;

use Mpietrucha\Utility\Finder;

abstract class File
{
    public static function directory(): string
    {
        return 'vendor/bin';
    }

    public static function name(): string
    {
        return 'pint';
    }

    public static function altitude(): int
    {
        return 3;
    }

    public static function find(): string
    {
        $finder = __DIR__ |> Finder::create()->files()->in(...);

        static::altitude() |> $finder->climb(...);

        static::directory() |> $finder->path(...);

        static::name() |> $finder->name(...);

        return $finder->get()->firstOrFail();
    }
}
