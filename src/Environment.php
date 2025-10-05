<?php

namespace Mpietrucha\Pint;

use Mpietrucha\Pint\Contracts\ArgvInterface;
use Mpietrucha\Pint\Contracts\ConfigInterface;
use Mpietrucha\Pint\Contracts\EnvironmentInterface;
use Mpietrucha\Pint\Contracts\ExecutableInterface;
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
        return $this->executable ??= Environment\Executable::find();
    }

    public function argv(): ArgvInterface
    {
        return $this->argv ??= Environment\Argv::capture();
    }

    public function config(): ConfigInterface
    {
        return $this->config ??= Environment\Config::find();
    }
}
