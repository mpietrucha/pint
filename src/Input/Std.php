<?php

namespace Mpietrucha\Pint\Input;

use Mpietrucha\Pint\Contracts\EnvironmentInterface;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Stream;
use Mpietrucha\Utility\Stream\Contracts\StreamInterface;
use Mpietrucha\Utility\Type;
use Symfony\Component\Process\Process;

class Std extends None
{
    public function __construct(protected ?StreamInterface $response = null)
    {
    }

    public static function capture(): StreamInterface
    {
        return Stream::input()->unleash() |> Filesystem\Stream::temporary()->paste(...);
    }

    public function command(EnvironmentInterface $environment): ?array
    {
        if ($this->excluded($environment)) {
            return null;
        }

        return [$environment->executable(), $this->response()->file(), '--silent', ...$environment->config()];
    }

    public function configure(Process $process): void
    {
    }

    public function response(): StreamInterface
    {
        return $this->response ??= static::capture();
    }

    protected function excluded(EnvironmentInterface $environment): bool
    {
        if ($environment->argv()->path() |> Type::null(...)) {
            return false;
        }

        return $environment->argv()->path() |> $environment->config()->excluded(...);
    }

    protected static function compatibility(EnvironmentInterface $environment): bool
    {
        return $environment->argv()->contains('--std');
    }
}
