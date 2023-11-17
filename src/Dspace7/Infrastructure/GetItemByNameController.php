<?php 

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetItemByNameUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\ItemRequests;
use Illuminate\Http\Request;

final class GetItemByNameController
{

    private $itemRequests;

    public function __construct(ItemRequests $itemRequests)
    {
        $this->itemRequests = $itemRequests;
    }

    public function handler(Request $request)
    {
        $item = (new GetItemByNameUseCase($this->itemRequests))->handler($request->name);
        return $item;
    }

}