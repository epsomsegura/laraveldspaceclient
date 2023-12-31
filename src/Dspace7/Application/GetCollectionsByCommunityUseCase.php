<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Application;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Collection;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts\CollectionContract;

final class GetCollectionsByCommunityUseCase
{
    private $collectionContract;
    public function __construct(
        CollectionContract $collectionContract
    ) {
        $this->collectionContract = $collectionContract;
    }
    public function handler(string $communityUUID, int $page): array
    {
        return $this->collectionContract->findAllByCommunityUUID($communityUUID, $page);
    }
}
