<?php 

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;


use Epsomsegura\Laraveldspaceclient\Dspace7\Application\UpdateCollectionUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CollectionRequests;

final class UpdateCollectionController
{
    private $collectionRequests;

    public function __construct()
    {
        $this->collectionRequests = new CollectionRequests();
    }

    public function handler(array $collection, string $uuid)
    {
        return (new UpdateCollectionUseCase($this->collectionRequests))->handler($collection, $uuid);
    }

}