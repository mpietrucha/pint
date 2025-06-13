<?php

namespace Mpietrucha\Zed\Pint;

use Mpietrucha\Zed\Pint\Contracts\ConfigInterface;
use Mpietrucha\Zed\Pint\Contracts\EnvironmentInterface;
use Mpietrucha\Zed\Pint\Contracts\ProcessInterface;
use Mpietrucha\Zed\Pint\Process\Command;
use Mpietrucha\Zed\Pint\Process\Subprocess;
use Psr\Http\Message\StreamInterface;

class Process implements ProcessInterface
{
    public function __construct(protected StreamInterface $input, protected string $cwd, protected ?string $config = null)
    {
    }

    public static function build(StreamInterface $input, ConfigInterface $config, EnvironmentInterface $environment): self
    {
        $config = $config->file();

        $cwd = $environment->cwd();

        return new self($input, $cwd, $config);
    }

    public function get(): ?StreamInterface
    {
        $input = $this->input();

        $command = Command::get($input, $this->cwd(), $this->config());

        if ($command === null) {
            return null;
        }

        Subprocess::create($command)->run();

        return $input;
    }

    protected function input(): StreamInterface
    {
        return $this->input;
    }

    protected function cwd(): string
    {
        return $this->cwd;
    }

    protected function config(): ?string
    {
        return $this->config;
    }
}
