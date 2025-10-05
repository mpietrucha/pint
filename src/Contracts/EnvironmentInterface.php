<?php

namespace Mpietrucha\Pint\Contracts;

interface EnvironmentInterface
{
    public function executable(): ExecutableInterface;

    public function argv(): ArgvInterface;

    public function config(): ConfigInterface;
}
