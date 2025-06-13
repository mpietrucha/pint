<?php

namespace Mpietrucha\Zed\Pint\Environment;

abstract class Cwd
{
    public static function get(): ?string
    {
        return getcwd() ?: null;
    }
}
