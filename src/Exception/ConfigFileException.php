<?php

namespace Mpietrucha\Pint\Exception;

use Mpietrucha\Utility\Throwable\InvalidArgumentException;

class ConfigFileException extends InvalidArgumentException
{
    public function configure(string $file): string
    {
        return '`%s` must be a file path to an existing pint config';
    }
}
