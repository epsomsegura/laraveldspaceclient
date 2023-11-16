<?php 

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetCollectionByHandleUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CollectionRequests;
use Illuminate\Http\Request;

final class GetCollectionByHandleController
{

    private $collectionRequest;

    public function __construct(CollectionRequests $collectionRequest)
    {
        $this->collectionRequest = $collectionRequest;
    }

    public function handler(Request $request)
    {
        $collection = (new GetCollectionByHandleUseCase($this->collectionRequest))->handler($request->handle);
        return $collection;
    }

}