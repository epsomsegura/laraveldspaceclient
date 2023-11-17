<?php 

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\CreateCommunityWithParentUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetCommunityByNameUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CommunityRequests;
use Illuminate\Http\Request;

final class CreateCommunityWithParentController
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
        $communityParent = (new GetCommunityByNameUseCase($this->communityRequest))->handler($request->communityParentName);
        $community = (new CreateCommunityWithParentUseCase($this->communityRequest))->handler($request->community, $communityParent->uuid());
        return $community;
    }

}