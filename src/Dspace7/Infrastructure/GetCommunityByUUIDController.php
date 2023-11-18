<?php 

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetCommunityByUUIDUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CommunityRequests;

final class GetCommunityByUUIDController
{
    private $communityRequest;
    public function __construct()
    {
        $this->communityRequest = new CommunityRequests();
    }
    public function handler(string $uuid)
    {
        return (new GetCommunityByUUIDUseCase($this->communityRequest))->handler($uuid);
    }
}