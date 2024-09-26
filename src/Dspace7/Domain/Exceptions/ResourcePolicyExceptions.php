<?php

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Exceptions;

use InvalidArgumentException;

class ResourcePolicyExceptions extends InvalidArgumentException
{
    public static function notFound()
    {
        return new static("Resource policy not found.");
    }

    public static function empty()
    {
        return new static("Resource policies is empty.");
    }
}
