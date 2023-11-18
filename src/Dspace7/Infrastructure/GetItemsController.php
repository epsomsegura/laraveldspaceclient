<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetItemsUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\ItemRequests;

final class GetItemsController
{
    private $itemsRequest;
    public function __construct()
    {
        $this->itemsRequest = new ItemRequests();
    }
    public function handler()
    {
        return (new GetItemsUseCase($this->itemsRequest))->handler();
    }
}
