<?php

namespace Mpietrucha\Pint\Contracts;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

/**
 * @extends \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, mixed>
 */
interface ArgvInterface extends EnumerableInterface
{
    public function path(): ?string;
}
