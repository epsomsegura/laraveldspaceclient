<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Application;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts\CollectionContract;

final class DeleteCollectionUseCase
{
    private $collectionContract;

    public function __construct(
        CollectionContract $collectionContract
    )
    {
        $this->collectionContract = $collectionContract;
    }

    public function handler($uuid) : string
    {
        return $this->collectionContract->delete($uuid);
    }
}
