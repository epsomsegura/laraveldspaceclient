<?php 

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\DeleteItemUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\ItemRequests;

final class DeleteItemController
{
    private $itemRequests;

    public function __construct()
    {
        $this->itemRequests = new ItemRequests();
    }

    public function handler(string $uuid)
    {
        return (new DeleteItemUseCase($this->itemRequests))->handler($uuid);
    }

}