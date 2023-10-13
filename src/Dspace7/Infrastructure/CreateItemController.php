<?php 

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\CreateItemUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetCollectionByNameUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetItemByHandleUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CollectionRequests;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\ItemRequests;
use Illuminate\Http\Request;

final class CreateItemController
{

    private $collectionRequests;
    private $itemRequests;

    public function __construct(
        CollectionRequests $collectionRequests,
        ItemRequests $itemRequests
    )
    {
        $this->collectionRequests = $collectionRequests;
        $this->itemRequests = $itemRequests;
    }

    public function handler(Request $request)
    {
        $collection = (new GetCollectionByNameUseCase($this->collectionRequests))->handler($request->collectionName);
        $item = (new CreateItemUseCase($this->itemRequests))->handler($request->item, $collection->uuid());
        return $item;
    }

    private function createItem($itemRequest){
        return $itemRequest;
    }

}