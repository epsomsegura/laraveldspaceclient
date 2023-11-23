<?php

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Exceptions;

use InvalidArgumentException;

class BundleExceptions extends InvalidArgumentException
{
    public static function notFound()
    {
        return new static("Bundle not found.");
    }
    
    public static function empty()
    {
        return new static("BUndles is empty.");
    }
}
