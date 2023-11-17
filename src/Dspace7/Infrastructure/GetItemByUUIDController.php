<?php 

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetItemByUUIDUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\ItemRequests;
use Illuminate\Http\Request;

final class GetItemByUUIDController
{

    private $itemRequests;

    public function __construct(ItemRequests $itemRequests)
    {
        $this->itemRequests = $itemRequests;
    }

    public function handler(Request $request, string $uuid)
    {
        $item = (new GetItemByUUIDUseCase($this->itemRequests))->handler($uuid);
        return $item;
    }

}