<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\DeleteCollectionUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CollectionRequests;

final class DeleteCollectionController
{
    private $collectionRequests;
    public function __construct()
    {
        $this->collectionRequests = new CollectionRequests();
    }
    public function handler(string $uuid)
    {
        return (new DeleteCollectionUseCase($this->collectionRequests))->handler($uuid);
    }
}
