<?php 

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\DeleteCommunityUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Application\UpdateCommunityUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CommunityRequests;
use Illuminate\Http\Request;

final class DeleteCommunityController
{
    private $communityRequest;

    public function __construct(
        CommunityRequests $communityRequest
    )
    {
        $this->communityRequest = $communityRequest;
    }

    public function handler(string $uuid)
    {
        $community = (new DeleteCommunityUseCase($this->communityRequest))->handler($uuid);
        return $community;
    }

}