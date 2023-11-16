<?php 

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\CreateCollectionUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetCommunityByNameUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CollectionRequests;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CommunityRequests;
use Illuminate\Http\Request;

final class CreateCollectionController
{
    private $collectionRequests;
    private $communityRequests;

    public function __construct(
        CollectionRequests $collectionRequests,
        CommunityRequests $communityRequests
    )
    {
        $this->collectionRequests = $collectionRequests;
        $this->communityRequests = $communityRequests;
    }

    public function handler(Request $request)
    {
        $community = (new GetCommunityByNameUseCase($this->communityRequests))->handler($request->communityName);
        $collection = (new CreateCollectionUseCase($this->collectionRequests))->handler($request->collection, $community->uuid());
        return $collection;
    }

}