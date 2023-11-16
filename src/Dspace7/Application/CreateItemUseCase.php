<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Application;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts\ItemContract;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Item;

final class CreateItemUseCase
{
    private $itemContract;

    public function __construct(
        ItemContract $itemContract
    )
    {
        $this->itemContract = $itemContract;
    }

    public function handler($item,string $collectionUUID)
    {
        return $this->itemContract->create($item,$collectionUUID);
    }
}
