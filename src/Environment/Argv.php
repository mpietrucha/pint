<?php

namespace Mpietrucha\Pint\Environment;

use Mpietrucha\Pint\Contracts\ArgvInterface;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

/**
 * @extends \Mpietrucha\Utility\Collection<int, string>
 */
class Argv extends Collection implements ArgvInterface
{
    /**
     * @var \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, string>|null
     */
    protected ?EnumerableInterface $paths = null;

    public static function capture(): static
    {
        return Argv\Input::capture() |> static::create(...);
    }

    public function paths(): EnumerableInterface
    {
        return $this->paths ??= Argv\Path::create() |> $this->collect()->filter(...);
    }
}
