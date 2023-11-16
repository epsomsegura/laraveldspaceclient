<?php

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Exceptions;

use InvalidArgumentException;

class CommunityExceptions extends InvalidArgumentException
{
    public static function notFound()
    {
        return new static("Community not found.");
    }
    
    public static function empty()
    {
        return new static("Community is empty.");
    }
}
