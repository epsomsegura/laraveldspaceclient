<?php 

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetItemByHandleUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\ItemRequests;

final class GetItemByHandleController
{

    private $itemRequests;

    public function __construct()
    {
        $this->itemRequests = new ItemRequests();
    }

    public function handler(string $handle)
    {
        return (new GetItemByHandleUseCase($this->itemRequests))->handler($handle);
    }

}