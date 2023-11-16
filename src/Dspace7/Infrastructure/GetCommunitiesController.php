<?php 

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetCommunitiesUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetCommunityByHandleUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetCommunityByUUIDUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CommunityRequests;
use Illuminate\Http\Request;

final class GetCommunitiesController
{

    private $communityRequest;

    public function __construct(CommunityRequests $communityRequest)
    {
        $this->communityRequest = $communityRequest;
    }

    public function handler(Request $request)
    {
        $communities = (new GetCommunitiesUseCase($this->communityRequest))->handler();
        return $communities;
    }

}