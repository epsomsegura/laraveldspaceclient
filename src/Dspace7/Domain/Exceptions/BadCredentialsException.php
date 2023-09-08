<?php

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Exceptions;

use InvalidArgumentException;

class BadCredentialsException extends InvalidArgumentException
{
    public static function emptyCredentials()
    {
        return new static("Bad credentials exception: API credentials and URL are required.");
    }

    public static function invalidData(string $message)
    {
        return new static("Bad credentials exception: ".$message.". Check data registered in platform");
    }

    public static function urlNotWorking(string $url){
        return new static("Bad credentials exception: ".$url." not working. Check data registered and check if url stil.");
    }
}
