<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetItemByUUIDUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\ItemRequests;

final class GetItemByUUIDController
{
    private $itemRequests;
    public function __construct()
    {
        $this->itemRequests = new ItemRequests();
    }
    public function handler(string $uuid)
    {
        return (new GetItemByUUIDUseCase($this->itemRequests))->handler($uuid);
    }
}
