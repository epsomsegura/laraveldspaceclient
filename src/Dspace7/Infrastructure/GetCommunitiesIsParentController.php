<?php 

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetCommunitiesIsParentUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CommunityRequests;

final class GetCommunitiesIsParentController
{

    private $communityRequest;

    public function __construct()
    {
        $this->communityRequest = new CommunityRequests();
    }

    public function handler()
    {
        return (new GetCommunitiesIsParentUseCase($this->communityRequest))->handler();
    }

}