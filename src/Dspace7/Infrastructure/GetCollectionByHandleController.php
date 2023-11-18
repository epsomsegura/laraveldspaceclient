<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetCollectionByHandleUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CollectionRequests;

final class GetCollectionByHandleController
{
    private $collectionRequest;
    public function __construct()
    {
        $this->collectionRequest = new CollectionRequests();
    }
    public function handler(string $handle)
    {
        return (new GetCollectionByHandleUseCase($this->collectionRequest))->handler($handle);
    }
}
