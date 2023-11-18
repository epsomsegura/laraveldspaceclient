<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetCollectionsUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CollectionRequests;

final class GetCollectionsController
{

    private $collectionRequest;

    public function __construct() {
        $this->collectionRequest = new CollectionRequests();
    }

    public function handler()
    {
        return (new GetCollectionsUseCase($this->collectionRequest))->handler();
    }
}
