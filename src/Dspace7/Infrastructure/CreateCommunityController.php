<?php 

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\CreateCommunityUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Application\CreateItemUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetCollectionByNameUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetItemByHandleUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CollectionRequests;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CommunityRequests;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\ItemRequests;
use Illuminate\Http\Request;

final class CreateCommunityController
{
    private $communityRequest;

    public function __construct(
        CommunityRequests $communityRequest
    )
    {
        $this->communityRequest = $communityRequest;
    }

    public function handler(Request $request)
    {
        $community = (new CreateCommunityUseCase($this->communityRequest))->handler($request->community);
        return $community;
    }

}