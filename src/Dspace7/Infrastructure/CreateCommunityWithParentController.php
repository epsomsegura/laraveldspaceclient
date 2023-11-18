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
    public function __construct()
    {
        $this->communityRequest = new CommunityRequests();
    }
    public function handler(string $communityParentName, array $community)
    {
        $communityParent = (new GetCommunityByNameUseCase($this->communityRequest))->handler($communityParentName);
        return (new CreateCommunityWithParentUseCase($this->communityRequest))->handler($community, $communityParent->uuid());
    }
}
