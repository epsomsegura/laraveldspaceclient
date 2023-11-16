<?php 

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\DeleteCollectionUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Application\DeleteCommunityUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Application\UpdateCommunityUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CollectionRequests;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CommunityRequests;
use Illuminate\Http\Request;

final class DeleteCollectionController
{
    private $collectionRequests;

    public function __construct(
        CollectionRequests $collectionRequests
    )
    {
        $this->collectionRequests = $collectionRequests;
    }

    public function handler(string $uuid)
    {
        $collection = (new DeleteCollectionUseCase($this->collectionRequests))->handler($uuid);
        return $collection;
    }

}