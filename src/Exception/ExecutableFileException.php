<?php

namespace Mpietrucha\Pint\Exception;

use Mpietrucha\Utility\Throwable\InvalidArgumentException;

class ExecutableFileException extends InvalidArgumentException
{
    public function configure(string $file): string
    {
        return '`%s` must be a valid path to an existing, executable Pint binary';
    }
}
