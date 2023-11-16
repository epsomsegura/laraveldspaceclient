<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetCollectionsUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CollectionRequests;
use Illuminate\Http\Request;

final class GetCollectionsController
{

    private $collectionRequest;

    public function __construct(
        CollectionRequests $collectionRequest
    ) {
        $this->collectionRequest = $collectionRequest;
    }

    public function handler(Request $request)
    {
        $communities = (new GetCollectionsUseCase($this->collectionRequest))->handler();
        return $communities;
    }
}
