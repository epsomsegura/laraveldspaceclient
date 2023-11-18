<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\CreateItemUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetCollectionByNameUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CollectionRequests;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\ItemRequests;
use Illuminate\Http\Request;

final class CreateItemController
{
    private $collectionRequests;
    private $itemRequests;
    public function __construct()
    {
        $this->collectionRequests = new CollectionRequests();
        $this->itemRequests = new ItemRequests();
    }
    public function handler(array $item, string $collectionName)
    {
        $collection = (new GetCollectionByNameUseCase($this->collectionRequests))->handler($collectionName);
        return (new CreateItemUseCase($this->itemRequests))->handler($item, $collection->uuid());
    }
}
