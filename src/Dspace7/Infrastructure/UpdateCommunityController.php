<?php 

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;


use Epsomsegura\Laraveldspaceclient\Dspace7\Application\UpdateCommunityUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CommunityRequests;
use Illuminate\Http\Request;

final class UpdateCommunityController
{
    private $communityRequest;

    public function __construct(
        CommunityRequests $communityRequest
    )
    {
        $this->communityRequest = $communityRequest;
    }

    public function handler($community, string $uuid)
    {
        $community = (new UpdateCommunityUseCase($this->communityRequest))->handler($community, $uuid);
        return $community;
    }

}