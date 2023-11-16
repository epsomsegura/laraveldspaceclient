<?php 

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetCollectionByUUIDUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CollectionRequests;
use Illuminate\Http\Request;

final class GetCollectionByUUIDController
{

    private $collectionRequest;

    public function __construct(CollectionRequests $collectionRequest)
    {
        $this->collectionRequest = $collectionRequest;
    }

    public function handler(Request $request, string $uuid)
    {
        $collection = (new GetCollectionByUUIDUseCase($this->collectionRequest))->handler($uuid);
        return $collection;
    }

}