<?php

namespace Mpietrucha\Zed\Pint\Process;

use Symfony\Component\Process\PhpSubprocess;

final class Subprocess extends PhpSubprocess
{
    /**
     * @param  string[]  $command
     */
    public static function create(array $command): self
    {
        return new self($command);
    }
}
