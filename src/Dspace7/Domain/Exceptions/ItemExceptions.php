<?php

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Exceptions;

use InvalidArgumentException;

class ItemExceptions extends InvalidArgumentException
{
    public static function notFound()
    {
        return new static("Item not found.");
    }
    
    public static function empty()
    {
        return new static("Items is empty.");
    }
}
