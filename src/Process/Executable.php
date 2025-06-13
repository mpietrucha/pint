<?php

namespace Mpietrucha\Zed\Pint\Process;

use Mpietrucha\Zed\Pint\Filesystem\File;
use Mpietrucha\Zed\Pint\Filesystem\Path;

abstract class Executable
{
    public static function bin(): string
    {
        return Path::join('vendor', 'bin', 'pint');
    }

    public static function get(string $cwd): ?string
    {
        return File::find(static::bin(), $cwd);
    }
}
