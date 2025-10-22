<?php

namespace Mpietrucha\Pint;

use Mpietrucha\Pint\Contracts\EnvironmentInterface;
use Mpietrucha\Pint\Contracts\InputInterface;
use Mpietrucha\Pint\Input\Std;
use Mpietrucha\Pint\Input\Transparent;
use Mpietrucha\Utility\Arr;
use Mpietrucha\Utility\Collection;

abstract class Input
{
    /**
     * @var \Mpietrucha\Utility\Collection<int, \Mpietrucha\Pint\Contracts\InputInterface>|null
     */
    protected static ?Collection $handlers = null;

    public static function use(InputInterface $input, int $index = 0): void
    {
        static::handlers()->splice($index, 0, Arr::wrap($input));
    }

    public static function flush(): void
    {
        static::$handlers = null;
    }

    public static function get(EnvironmentInterface $environment): InputInterface
    {
        return static::handlers()->first->compatible($environment);
    }

    /**
     * @return \Mpietrucha\Utility\Collection<int, \Mpietrucha\Pint\Contracts\InputInterface>
     */
    protected static function handlers(): Collection
    {
        return static::$handlers ??= static::defaults() |> Collection::create(...);
    }

    /**
     * @return array<int, \Mpietrucha\Pint\Contracts\InputInterface>
     */
    protected static function defaults(): array
    {
        return [
            Std::create(),
            Transparent::create(),
        ];
    }
}
