<?php 

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\UpdateItemUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\ItemRequests;
use Illuminate\Http\Request;

final class UpdateItemController
{
    private $itemRequests;

    public function __construct(
        ItemRequests $itemRequests
    )
    {
        $this->itemRequests = $itemRequests;
    }

    public function handler(Request $request, string $uuid)
    {
        $item = (new UpdateItemUseCase($this->itemRequests))->handler($request->item, $uuid);
        return $item;
    }

}