<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetCollectionsUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetItemsUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CollectionRequests;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\ItemRequests;
use Illuminate\Http\Request;

final class GetItemsController
{

    private $itemsRequest;

    public function __construct(
        ItemRequests $itemsRequest
    ) {
        $this->itemsRequest = $itemsRequest;
    }

    public function handler(Request $request)
    {
        $items = (new GetItemsUseCase($this->itemsRequest))->handler();
        return $items;
    }
}
