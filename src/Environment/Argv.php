<?php

namespace Mpietrucha\Pint\Environment;

use Mpietrucha\Pint\Contracts\ArgvInterface;
use Mpietrucha\Utility\Collection;

/**
 * @extends \Mpietrucha\Utility\Collection<int, mixed>
 */
class Argv extends Collection implements ArgvInterface
{
    protected ?string $path = null;

    /**
     * @param  array<int, mixed>  $argv
     */
    public function __construct(array $argv)
    {
        parent::__construct($argv);

        $this->path = Argv\Path::get($argv);
    }

    public static function capture(): static
    {
        return Argv\Input::capture() |> static::create(...);
    }

    public function path(): ?string
    {
        return $this->path;
    }
}
