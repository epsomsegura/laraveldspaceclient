<?php 

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\CreateCommunityUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CommunityRequests;

final class CreateCommunityController
{
    private $communityRequest;

    public function __construct()
    {
        $this->communityRequest = new CommunityRequests();
    }

    public function handler(array $community)
    {
        return (new CreateCommunityUseCase($this->communityRequest))->handler($community);
    }

}