<?php

namespace Mpietrucha\Zed\Pint\Environment;

use Illuminate\Support\Arr;

abstract class Argv
{
    /**
     * @return string[]
     */
    public static function get(): array
    {
        return Arr::array($_SERVER, 'argv');
    }
}
