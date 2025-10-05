<?php

namespace Mpietrucha\Pint\Contracts;

use Mpietrucha\Utility\Stream\Contracts\StreamInterface;

interface ApplicationInterface
{
    public function environment(): EnvironmentInterface;

    public function input(): InputInterface;

    public function output(): StreamInterface;

    public function run(): void;
}
