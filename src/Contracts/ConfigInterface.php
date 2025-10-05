<?php

namespace Mpietrucha\Pint\Contracts;

use Mpietrucha\Utility\Contracts\ArrayableInterface;
use Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface;

/**
 * @extends \Mpietrucha\Utility\Contracts\ArrayableInterface<int, string>
 */
interface ConfigInterface extends ArrayableInterface
{
    public function file(): string;

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, mixed>
     */
    public function get(): EnumerableInterface;

    /**
     * @return \Mpietrucha\Utility\Enumerable\Contracts\EnumerableInterface<int, mixed>
     */
    public function excludes(): EnumerableInterface;

    public function excluded(string $path): bool;

    public function included(string $path): bool;
}
