<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Application;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts\CommunityContract;

final class GetCommunityByHandleUseCase
{
    private $communityContract;

    public function __construct(
        CommunityContract $communityContract
    )
    {
        $this->communityContract = $communityContract;
    }

    public function handler(string $handle)
    {
        return $this->communityContract->findOneByHandle($handle);
    }
}
