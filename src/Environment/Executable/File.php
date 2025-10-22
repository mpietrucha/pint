<?php

namespace Mpietrucha\Pint\Environment\Executable;

use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Filesystem\Temporary;
use Mpietrucha\Utility\Stream;
use Mpietrucha\Utility\Stream\Contracts\StreamInterface;

abstract class File
{
    protected static string $url = 'https://github.com/laravel/pint/raw/refs/heads/main/builds/pint';

    public static function url(): string
    {
        return static::$url;
    }

    public static function get(): string
    {
        $destination = static::destination();

        return Filesystem::executable($destination) ? $destination : static::download($destination);
    }

    public static function download(?string $destination = null): string
    {
        $source = Stream::open(static::url(), 'r');

        return static::store($destination, $source);
    }

    public static function destination(): string
    {
        return Temporary::get('pint');
    }

    protected static function store(?string $destination, StreamInterface $source): string
    {
        $destination ??= static::destination();

        Filesystem::put($destination, $source->resource());

        Filesystem::chmod($destination, 0755);

        return $destination;
    }
}
