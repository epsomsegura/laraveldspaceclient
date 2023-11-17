<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Application;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts\CollectionContract;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts\ItemContract;

final class UpdateItemUseCase
{
    private $itemContract;

    public function __construct(
        ItemContract $itemContract
    )
    {
        $this->itemContract = $itemContract;
    }

    public function handler($item,string $uuid)
    {
        return $this->itemContract->update($item,$uuid);
    }
}
