<?php

namespace Mpietrucha\Pint\Contracts;

use Mpietrucha\Utility\Contracts\CompatibleInterface;
use Mpietrucha\Utility\Stream\Contracts\StreamInterface;
use Symfony\Component\Process\Process;

interface InputInterface extends CompatibleInterface
{
    /**
     * @return array<int, string|null>|null
     */
    public function command(EnvironmentInterface $environment): ?array;

    public function configure(Process $process): void;

    public function response(): ?StreamInterface;
}
