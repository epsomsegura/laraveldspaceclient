<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetBundlesByItemUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetItemByHandleUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\BundleRequests;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\ItemRequests;

final class GetBundlesByItemController
{
    private $itemRequests;
    private $bundleRequests;
    public function __construct()
    {
        $this->bundleRequests = new BundleRequests();
        $this->itemRequests = new ItemRequests();
    }
    public function handler(string $itemHandle, ?int $page)
    {
        $item = (new GetItemByHandleUseCase($this->itemRequests))->handler($itemHandle);
        return (new GetBundlesByItemUseCase($this->bundleRequests))->handler($item->uuid(),($page ?? 0)); 
    }
}
