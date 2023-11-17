<?php 

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetCommunitiesIsParentUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CommunityRequests;
use Illuminate\Http\Request;

final class GetCommunitiesIsParentController
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
        $communities = (new GetCommunitiesIsParentUseCase($this->communityRequest))->handler();
        return $communities;
    }

}