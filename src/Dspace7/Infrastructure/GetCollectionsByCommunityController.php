<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetCollectionsByCommunityUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetCommunityByNameUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CollectionRequests;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CommunityRequests;

final class GetCollectionsByCommunityController
{
    private $collectionRequest;
    private $communityRequests;
    public function __construct()
    {
        $this->collectionRequest = new CollectionRequests();
        $this->communityRequests = new CommunityRequests();
    }
    public function handler(string $communityName)
    {
        $community = (new GetCommunityByNameUseCase($this->communityRequests))->handler($communityName);
        return (new GetCollectionsByCommunityUseCase($this->collectionRequest))->handler($community->uuid());
    }
}
