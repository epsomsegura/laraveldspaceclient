<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetCommunityByNameUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CommunityRequests;

final class GetCommunityByNameController
{
    private $communityRequest;
    public function __construct()
    {
        $this->communityRequest = new CommunityRequests();
    }
    public function handler(string $name)
    {
        return (new GetCommunityByNameUseCase($this->communityRequest))->handler($name);
    }
}
