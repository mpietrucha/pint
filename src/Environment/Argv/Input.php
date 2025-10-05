<?php

namespace Mpietrucha\Pint\Environment\Argv;

use Symfony\Component\Console\Input\ArgvInput;

abstract class Input
{
    /**
     * @return array<int, mixed>
     */
    public static function capture(): array
    {
        return new ArgvInput()->getRawTokens();
    }
}
