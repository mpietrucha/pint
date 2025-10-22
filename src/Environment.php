<?php

namespace Mpietrucha\Pint;

use Mpietrucha\Pint\Contracts\ArgvInterface;
use Mpietrucha\Pint\Contracts\ConfigInterface;
use Mpietrucha\Pint\Contracts\EnvironmentInterface;
use Mpietrucha\Pint\Contracts\ExecutableInterface;
use Mpietrucha\Pint\Environment\Argv;
use Mpietrucha\Pint\Environment\Config;
use Mpietrucha\Pint\Environment\Executable;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;

class Environment implements CreatableInterface, EnvironmentInterface
{
    use Creatable;

    public function __construct(
        protected ?ExecutableInterface $executable = null,
        protected ?ArgvInterface $argv = null,
        protected ?ConfigInterface $config = null
    ) {
    }

    public function executable(): ExecutableInterface
    {
        return $this->executable ??= Executable::get();
    }

    public function argv(): ArgvInterface
    {
        return $this->argv ??= Argv::capture();
    }

    public function config(): ConfigInterface
    {
        return $this->config ??= Config::find();
    }
}
