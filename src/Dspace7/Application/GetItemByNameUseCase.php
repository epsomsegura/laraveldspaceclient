<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Application;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts\ItemContract;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Item;

final class GetItemByNameUseCase
{
    private $itemContract;
    public function __construct(
        ItemContract $itemContract
    ) {
        $this->itemContract = $itemContract;
    }
    public function handler(string $name): ?Item
    {
        return $this->itemContract->findOneByName($name);
    }
}
