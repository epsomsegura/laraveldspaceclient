<?php 

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetCommunityByHandleUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CommunityRequests;
use Illuminate\Http\Request;

final class GetCommunityByHandleController
{
    private $communityRequest;

    public function __construct(CommunityRequests $communityRequest)
    {
        $this->communityRequest = $communityRequest;
    }

    public function handler(Request $request)
    {
        $community = (new GetCommunityByHandleUseCase($this->communityRequest))->handler($request->handle);
        return $community;
    }
}