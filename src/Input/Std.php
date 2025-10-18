<?php

namespace Mpietrucha\Pint\Input;

use Mpietrucha\Pint\Contracts\EnvironmentInterface;
use Mpietrucha\Utility\Filesystem;
use Mpietrucha\Utility\Normalizer;
use Mpietrucha\Utility\Stream;
use Mpietrucha\Utility\Stream\Contracts\StreamInterface;
use Symfony\Component\Process\Process;

class Std extends Transparent
{
    public function __construct(protected ?StreamInterface $response = null)
    {
    }

    public static function capture(): StreamInterface
    {
        return Stream::input()->unleash() |> Filesystem\Stream::temporary()->paste(...);
    }

    public function due(EnvironmentInterface $environment): bool
    {
        $candidates = $environment->argv()->paths();

        if ($candidates->isEmpty()) {
            return true;
        }

        return $candidates->first() |> $environment->config()->included(...);
    }

    final public function undue(EnvironmentInterface $environment): bool
    {
        return $this->due($environment) |> Normalizer::not(...);
    }

    public function command(EnvironmentInterface $environment): ?array
    {
        if ($this->undue($environment)) {
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

    protected static function compatibility(EnvironmentInterface $environment): bool
    {
        return $environment->argv()->contains('--std');
    }
}
