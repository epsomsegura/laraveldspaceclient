<?php 

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetCollectionByNameUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CollectionRequests;
use Illuminate\Http\Request;

final class GetCollectionByNameController
{

    private $collectionRequest;

    public function __construct(CollectionRequests $collectionRequest)
    {
        $this->collectionRequest = $collectionRequest;
    }

    public function handler(Request $request)
    {
        $collection = (new GetCollectionByNameUseCase($this->collectionRequest))->handler($request->name);
        dd($collection);
    }

}