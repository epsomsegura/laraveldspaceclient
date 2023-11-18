<?php 

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetCommunitiesWhereParentUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetCommunityByNameUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CommunityRequests;

final class GetCommunitiesWhereParentController
{

    private $communityRequest;

    public function __construct()
    {
        $this->communityRequest = new CommunityRequests();
    }

    public function handler(string $communityParentName)
    {
        $communityParent = (new GetCommunityByNameUseCase($this->communityRequest))->handler($communityParentName);
        return (new GetCommunitiesWhereParentUseCase($this->communityRequest))->handler($communityParent->uuid());
    }

}