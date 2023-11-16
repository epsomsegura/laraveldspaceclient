<?php 

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetCommunityByUUIDUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CommunityRequests;
use Illuminate\Http\Request;

final class GetCommunityByUUIDController
{
    private $communityRequest;

    public function __construct(CommunityRequests $communityRequest)
    {
        $this->communityRequest = $communityRequest;
    }

    public function handler(Request $request, string $uuid)
    {
        $communities = (new GetCommunityByUUIDUseCase($this->communityRequest))->handler($uuid);
        return $communities;
    }
}