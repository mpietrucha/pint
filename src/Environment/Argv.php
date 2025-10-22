<?php

namespace Mpietrucha\Pint\Environment;

use Mpietrucha\Pint\Contracts\ArgvInterface;
use Mpietrucha\Pint\Environment\Argv\Input;
use Mpietrucha\Pint\Environment\Argv\Path;
use Mpietrucha\Utility\Collection;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

/**
 * @extends \Mpietrucha\Utility\Collection<int, string>
 *
 * @phpstan-ignore class.missingImplements
 */
class Argv extends Collection implements ArgvInterface
{
    /**
     * @var \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, string>|null
     */
    protected ?EnumerableInterface $paths = null;

    public static function capture(): static
    {
        return Input::capture() |> static::create(...);
    }

    public function paths(): EnumerableInterface
    {
        return $this->paths ??= Path::create() |> $this->collect()->filter(...);
    }
}
