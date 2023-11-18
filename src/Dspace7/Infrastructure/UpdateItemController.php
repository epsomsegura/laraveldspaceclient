<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\UpdateItemUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\ItemRequests;

final class UpdateItemController
{
    private $itemRequests;
    public function __construct()
    {
        $this->itemRequests = new ItemRequests();
    }
    public function handler(array $item, string $uuid)
    {
        return (new UpdateItemUseCase($this->itemRequests))->handler($item, $uuid);
    }
}
