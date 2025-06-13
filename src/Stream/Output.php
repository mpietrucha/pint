<?php

namespace Mpietrucha\Zed\Pint\Stream;

use Psr\Http\Message\StreamInterface;

abstract class Output
{
    public static function emit(StreamInterface $response): void
    {
        $response = $response->detach();

        if (is_resource($response) === false) {
            return;
        }

        stream_copy_to_stream($response, STDOUT);
    }
}
