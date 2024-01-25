<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Application;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts\CommunityContract;

final class GetCommunitiesWhereNameUseCase
{
    private $communityContract;
    public function __construct(
        CommunityContract $communityContract
    ) {
        $this->communityContract = $communityContract;
    }
    public function handler(string $name, int $page): array
    {
        return $this->communityContract->findAllWhereName($name, $page);
    }
}
