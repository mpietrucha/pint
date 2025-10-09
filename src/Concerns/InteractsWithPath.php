<?php

namespace Mpietrucha\Pint\Concerns;

use Mpietrucha\Utility\Concerns\Compatible;
use Mpietrucha\Utility\Type;

trait InteractsWithPath
{
    use Compatible;

    protected static function compatibility(mixed $value): bool
    {
        return Type::string($value);
    }
}
