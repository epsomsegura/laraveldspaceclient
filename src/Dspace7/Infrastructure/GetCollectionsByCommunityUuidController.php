<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetCollectionsByCommunityUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CollectionRequests;

final class GetCollectionsByCommunityUuidController
{
    private $collectionRequest;
    public function __construct()
    {
        $this->collectionRequest = new CollectionRequests();
    }
    public function handler(string $communityUuid, ?int $page)
    {
        return (new GetCollectionsByCommunityUseCase($this->collectionRequest))->handler($communityUuid,($page ?? 0));
    }
}
