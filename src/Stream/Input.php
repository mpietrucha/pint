<?php

namespace Mpietrucha\Zed\Pint\Stream;

use Nyholm\Psr7\Stream;
use Psr\Http\Message\StreamInterface;

abstract class Input
{
    public static function capture(): StreamInterface
    {
        $tmp = tmpfile();

        stream_set_blocking($input = STDIN, false);

        stream_copy_to_stream($input, $tmp);

        $stream = Stream::create($tmp);

        $stream->rewind();

        return $stream;
    }
}
