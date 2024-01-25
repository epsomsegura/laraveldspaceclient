<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetCommunitiesWhereNameUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CommunityRequests;

final class GetCommunitiesWhereNameController
{
    private $communityRequest;
    public function __construct()
    {
        $this->communityRequest = new CommunityRequests();
    }
    public function handler(string $name, ?int $page)
    {
        return (new GetCommunitiesWhereNameUseCase($this->communityRequest))->handler($name,($page ?? 0));
    }
}
