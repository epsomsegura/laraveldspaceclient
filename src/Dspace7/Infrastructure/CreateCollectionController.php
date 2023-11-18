<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\CreateCollectionUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetCommunityByNameUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CollectionRequests;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CommunityRequests;

final class CreateCollectionController
{
    private $collectionRequests;
    private $communityRequests;
    public function __construct()
    {
        $this->collectionRequests = new CollectionRequests();
        $this->communityRequests = new CommunityRequests();
    }
    public function handler(array $collection, string $communityName)
    {
        $community = (new GetCommunityByNameUseCase($this->communityRequests))->handler($communityName);
        return (new CreateCollectionUseCase($this->collectionRequests))->handler($collection, $community->uuid());
    }
}
