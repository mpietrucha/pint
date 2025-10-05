<?php

namespace Mpietrucha\Pint\Environment\Config;

use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Finder;

abstract class File
{
    public static function name(): string
    {
        return 'pint.json';
    }

    public static function default(): string
    {
        return static::name() |> Filesystem::ephemeral(...);
    }

    public static function find(): string
    {
        $finder = static::name() |> Finder::create()
            ->files()
            ->name(...);

        return $finder->get()->first() ?? static::default();
    }
}
