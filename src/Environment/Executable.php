<?php

namespace Mpietrucha\Pint\Environment;

use Mpietrucha\Pint\Contracts\ExecutableInterface;
use Mpietrucha\Pint\Exception\ExecutableException;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Concerns\Stringable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Filesystem;

class Executable implements CreatableInterface, ExecutableInterface
{
    use Creatable, Stringable;

    public function __construct(protected string $file)
    {
        if (Filesystem::executable($file)) {
            return;
        }

        ExecutableException::for($file)->throw();
    }

    public static function find(): static
    {
        return Executable\File::find() |> static::create(...);
    }

    public function toString(): string
    {
        return $this->file;
    }
}
