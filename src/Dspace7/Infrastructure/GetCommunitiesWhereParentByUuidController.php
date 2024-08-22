<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetCommunitiesWhereParentUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\CommunityRequests;

final class GetCommunitiesWhereParentByUuidController
{
    private $communityRequest;
    public function __construct()
    {
        $this->communityRequest = new CommunityRequests();
    }
    public function handler(string $communityParentUuid, ?int $page)
    {
        return (new GetCommunitiesWhereParentUseCase($this->communityRequest))->handler($communityParentUuid, ($page ?? 0));
    }
}
