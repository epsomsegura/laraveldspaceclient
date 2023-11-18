<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Application;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Community;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts\CommunityContract;

final class UpdateCommunityUseCase
{
    private $communityContract;
    public function __construct(
        CommunityContract $communityContract
    ) {
        $this->communityContract = $communityContract;
    }
    public function handler($community, string $uuid): ?Community
    {
        return $this->communityContract->update($community, $uuid);
    }
}
