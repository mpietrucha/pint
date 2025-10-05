<?php

namespace Mpietrucha\Pint;

use Mpietrucha\Pint\Contracts\ApplicationInterface;
use Mpietrucha\Pint\Contracts\EnvironmentInterface;
use Mpietrucha\Pint\Contracts\InputInterface;
use Mpietrucha\Utility\Concerns\Creatable;
use Mpietrucha\Utility\Contracts\CreatableInterface;
use Mpietrucha\Utility\Stream;
use Mpietrucha\Utility\Stream\Contracts\StreamInterface;
use Mpietrucha\Utility\Type;
use Symfony\Component\Process\Process;

class Application implements ApplicationInterface, CreatableInterface
{
    use Creatable;

    public function __construct(
        protected ?EnvironmentInterface $environment = null,
        protected ?InputInterface $input = null,
        protected ?StreamInterface $output = null
    ) {
    }

    public function environment(): EnvironmentInterface
    {
        return $this->environment ??= Environment::create();
    }

    public function input(): InputInterface
    {
        return $this->input ??= $this->environment() |> Input::get(...);
    }

    public function output(): StreamInterface
    {
        return $this->output ??= Stream::output()->unleash();
    }

    public function run(): void
    {
        $this->process();

        $response = $this->input()->response();

        Type::not()->null($response) && $response->restore() |> $this->output()->write(...);
    }

    protected function process(): void
    {
        $command = $this->environment() |> $this->input()->command(...);

        if (Type::null($command)) {
            return;
        }

        $this->input()->configure($process = new Process($command));

        $process->run();
    }
}
