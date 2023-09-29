<?php 

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetItemByHandleUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\ItemRequests;
use Illuminate\Http\Request;

final class GetItemByHandleController
{

    private $itemRequests;

    public function __construct(ItemRequests $itemRequests)
    {
        $this->itemRequests = $itemRequests;
    }

    public function handler(Request $request)
    {
        $item = (new GetItemByHandleUseCase($this->itemRequests))->handler($request->handle);
        dd($item);
    }

}