<?php

namespace Mpietrucha\Zed\Pint;

use Mpietrucha\Zed\Pint\Contracts\EnvironmentInterface;
use Mpietrucha\Zed\Pint\Environment\Cwd;
use Mpietrucha\Zed\Pint\Environment\File;

final class Environment implements EnvironmentInterface
{
    public function __construct(protected string $cwd, protected ?string $file = null)
    {
    }

    public static function build(): static
    {
        $cwd = Cwd::get() ?? '';

        $file = File::get();

        return new self($cwd, $file);
    }

    public function cwd(): string
    {
        return $this->cwd;
    }

    public function file(): ?string
    {
        return $this->file;
    }
}
