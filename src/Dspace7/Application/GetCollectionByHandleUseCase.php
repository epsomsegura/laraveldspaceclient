<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Application;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Collection;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts\CollectionContract;

final class GetCollectionByHandleUseCase
{
    private $collectionContract;

    public function __construct(
        CollectionContract $collectionContract
    )
    {
        $this->collectionContract = $collectionContract;
    }

    public function handler(string $handle) : Collection
    {
        return $this->collectionContract->findOneByHandle($handle);
    }
}
