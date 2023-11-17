<?php 

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\DeleteItemUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\ItemRequests;

final class DeleteItemController
{
    private $itemRequests;

    public function __construct(
        ItemRequests $itemRequests
    )
    {
        $this->itemRequests = $itemRequests;
    }

    public function handler(string $uuid)
    {
        $item = (new DeleteItemUseCase($this->itemRequests))->handler($uuid);
        return $item;
    }

}