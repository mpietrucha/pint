<?php

namespace Mpietrucha\Zed\Pint\Filesystem;

abstract class File
{
    public static function find(string $name, string $cwd, int $attempts = 2): ?string
    {
        $file = Path::join($cwd, $name);

        if (static::exists($file)) {
            return $file;
        }

        if ($attempts <= 1) {
            return null;
        }

        $cwd = dirname($cwd);

        return static::find($name, $cwd, --$attempts);
    }

    public static function exists(string $file): bool
    {
        return is_file($file);
    }

    public static function get(string $file): ?string
    {
        if (static::exists($file) === false) {
            return null;
        }

        return file_get_contents($file) ?: null;
    }

    /**
        @return null|string[]
     */
    public static function json(string $file): ?array
    {
        $contents = static::get($file);

        if ($contents == null) {
            return null;
        }

        return json_decode($contents, true);
    }
}
