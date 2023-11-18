<?php 

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetCollectionByNameUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CollectionRequests;

final class GetCollectionByNameController
{

    private $collectionRequest;

    public function __construct()
    {
        $this->collectionRequest = new CollectionRequests();
    }

    public function handler(string $name)
    {
        return (new GetCollectionByNameUseCase($this->collectionRequest))->handler($name);
    }

}