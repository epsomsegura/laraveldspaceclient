<?php

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Exceptions;

use InvalidArgumentException;

class BitstreamExceptions extends InvalidArgumentException
{
    public static function notFound()
    {
        return new static("Bitstream not found.");
    }

    public static function empty()
    {
        return new static("Bitstreams is empty.");
    }
}
