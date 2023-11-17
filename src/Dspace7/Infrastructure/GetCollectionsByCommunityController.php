<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetCollectionsByCommunityUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetCollectionsUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetCommunityByNameUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CollectionRequests;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CommunityRequests;
use Illuminate\Http\Request;

final class GetCollectionsByCommunityController
{

    private $collectionRequest;
    private $communityRequests;

    public function __construct(
        CollectionRequests $collectionRequest
    ) {
        $this->collectionRequest = $collectionRequest;
        $this->communityRequests = new CommunityRequests();
    }

    public function handler(Request $request)
    {
        $community = (new GetCommunityByNameUseCase($this->communityRequests))->handler($request->communityName);
        $communities = (new GetCollectionsByCommunityUseCase($this->collectionRequest))->handler($community->uuid());
        return $communities;
    }
}
