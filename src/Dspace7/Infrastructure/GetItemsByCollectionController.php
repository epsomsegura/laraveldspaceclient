<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetCollectionByNameUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetItemsByCollectionUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CollectionRequests;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\ItemRequests;
use Illuminate\Http\Request;

final class GetItemsByCollectionController
{

    private $collectionRequests;
    private $itemRequests;

    public function __construct(
        ItemRequests $itemRequests
    ) {
        $this->itemRequests = $itemRequests;
        $this->collectionRequests = new CollectionRequests();
    }

    public function handler(Request $request)
    {
        $collection = (new GetCollectionByNameUseCase($this->collectionRequests))->handler($request->collectionName);
        $items = (new GetItemsByCollectionUseCase($this->itemRequests))->handler($collection->uuid());
        return $items;
    }
}
