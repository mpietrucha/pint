<?php

namespace Mpietrucha\Zed\Pint\Filesystem;

abstract class Path
{
    public static function join(string ...$paths): string
    {
        return implode(DIRECTORY_SEPARATOR, $paths);
    }
}
