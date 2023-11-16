<?php 

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;


use Epsomsegura\Laraveldspaceclient\Dspace7\Application\UpdateCollectionUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Application\UpdateCommunityUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CollectionRequests;
use Illuminate\Http\Request;

final class UpdateCollectionController
{
    private $collectionRequests;

    public function __construct(
        CollectionRequests $collectionRequests
    )
    {
        $this->collectionRequests = $collectionRequests;
    }

    public function handler(Request $request, string $uuid)
    {
        $community = (new UpdateCollectionUseCase($this->collectionRequests))->handler($request->collection, $uuid);
        return $community;
    }

}