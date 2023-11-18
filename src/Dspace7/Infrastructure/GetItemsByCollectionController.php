<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetCollectionByNameUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetItemsByCollectionUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CollectionRequests;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\ItemRequests;

final class GetItemsByCollectionController
{
    private $collectionRequests;
    private $itemRequests;
    public function __construct()
    {
        $this->itemRequests = new ItemRequests();
        $this->collectionRequests = new CollectionRequests();
    }
    public function handler(string $collectionName)
    {
        $collection = (new GetCollectionByNameUseCase($this->collectionRequests))->handler($collectionName);
        return (new GetItemsByCollectionUseCase($this->itemRequests))->handler($collection->uuid());
    }
}
