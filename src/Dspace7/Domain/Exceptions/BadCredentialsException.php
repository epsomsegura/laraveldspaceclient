<?php

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Exceptions;

use InvalidArgumentException;

class BadCredentialsException extends InvalidArgumentException
{
    public static function create(
        ?string $dspaceApiUrl,
        ?string $dspaceApiUser,
        ?string $dspaceApiPass)
    {

        return new static("This is a exception testing");
    }
}