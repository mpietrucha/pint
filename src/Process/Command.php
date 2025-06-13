<?php

namespace Mpietrucha\Zed\Pint\Process;

use Psr\Http\Message\StreamInterface;

abstract class Command
{
    /**
     * @return null|string[]
     */
    public static function get(StreamInterface $input, string $cwd, ?string $config = null): ?array
    {
        $executable = Executable::get($cwd);

        if ($executable === null) {
            return null;
        }

        $file = Input::get($input);

        if ($file === null) {
            return null;
        }

        return [$executable, $file, '--quiet', '--config', (string) $config];
    }
}
