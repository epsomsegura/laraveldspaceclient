<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\CreateBundleUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetItemByHandleUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\BundleRequests;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\ItemRequests;

final class CreateBundleController
{
    private $bundleRequests;
    private $itemRequests;
    public function __construct()
    {
        $this->bundleRequests = new BundleRequests();
        $this->itemRequests = new ItemRequests();
    }
    public function handler(array $bundle, string $itemHandle)
    {
        $item = (new GetItemByHandleUseCase($this->itemRequests))->handler($itemHandle);
        return (new CreateBundleUseCase($this->bundleRequests))->handler($bundle, $item->uuid());
    }
}
