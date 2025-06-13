<?php

namespace Mpietrucha\Zed\Pint\Environment;

use Illuminate\Support\Arr;

abstract class File
{
    public static function get(): ?string
    {
        $argv = Argv::get();

        return Arr::get($argv, 1);
    }
}
