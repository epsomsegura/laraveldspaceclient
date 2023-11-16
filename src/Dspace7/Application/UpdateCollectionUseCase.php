<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Application;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts\CollectionContract;

final class UpdateCollectionUseCase
{
    private $collectionContract;

    public function __construct(
        CollectionContract $collectionContract
    )
    {
        $this->collectionContract = $collectionContract;
    }

    public function handler($collection,string $uuid)
    {
        return $this->collectionContract->update($collection,$uuid);
    }
}
