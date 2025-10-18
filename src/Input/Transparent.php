<?php

namespace Mpietrucha\Pint\Input;

use Mpietrucha\Pint\Contracts\EnvironmentInterface;
use Mpietrucha\Pint\Contracts\InputInterface;
use Mpietrucha\Utility\Concerns\Compatible;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Stream\Contracts\StreamInterface;
use Symfony\Component\Process\Process;

class Transparent implements CreatableInterface, InputInterface
{
    use Compatible, Creatable;

    public function command(EnvironmentInterface $environment): ?array
    {
        return [$environment->executable(), ...$environment->argv(), '--parallel'];
    }

    public function configure(Process $process): void
    {
        $process->setTTY(true);
    }

    public function response(): ?StreamInterface
    {
        return null;
    }

    protected static function compatibility(EnvironmentInterface $environment): bool
    {
        return true;
    }
}
