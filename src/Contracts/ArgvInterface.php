<?php

namespace Mpietrucha\Pint\Contracts;

use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

/**
 * @extends \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, string>
 */
interface ArgvInterface extends EnumerableInterface
{
    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, string>
     */
    public function paths(): EnumerableInterface;
}
