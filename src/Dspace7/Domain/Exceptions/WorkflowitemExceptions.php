<?php

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Exceptions;

use InvalidArgumentException;

class WorkflowitemExceptions extends InvalidArgumentException
{
    public static function notFound()
    {
        return new static("workflowitem not found.");
    }

    public static function empty()
    {
        return new static("workflowitems is empty.");
    }
}
