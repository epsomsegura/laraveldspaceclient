<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetCollectionByUUIDUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CollectionRequests;

final class GetCollectionByUUIDController
{
    private $collectionRequest;
    public function __construct()
    {
        $this->collectionRequest = new CollectionRequests();
    }
    public function handler(string $uuid)
    {
        return (new GetCollectionByUUIDUseCase($this->collectionRequest))->handler($uuid);
    }
}
