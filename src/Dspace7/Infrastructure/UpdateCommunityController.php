<?php 

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;


use Epsomsegura\Laraveldspaceclient\Dspace7\Application\UpdateCommunityUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CommunityRequests;

final class UpdateCommunityController
{
    private $communityRequest;

    public function __construct()
    {
        $this->communityRequest = new CommunityRequests();
    }

    public function handler(array $community, string $uuid)
    {
        return (new UpdateCommunityUseCase($this->communityRequest))->handler($community, $uuid);
    }

}