<?php

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Exceptions;

use InvalidArgumentException;

class CollectionExceptions extends InvalidArgumentException
{
    public static function notFound()
    {
        return new static("Collection not found.");
    }
    
    public static function empty()
    {
        return new static("Collection is empty.");
    }
}
