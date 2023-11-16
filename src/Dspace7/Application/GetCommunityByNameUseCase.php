<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Application;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts\CommunityContract;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts\ItemContract;

final class GetCommunityByNameUseCase
{
    private $communityContract;

    public function __construct(
        CommunityContract $communityContract
    )
    {
        $this->communityContract = $communityContract;
    }

    public function handler(string $name)
    {
        return $this->communityContract->findOneByName($name);
    }
}
