<?php

namespace Mpietrucha\Pint\Environment\Argv;

use Symfony\Component\Console\Input\ArgvInput;

abstract class Input
{
    /**
     * @return array<int, string>
     */
    public static function capture(): array
    {
        return new ArgvInput()->getRawTokens();
    }
}
