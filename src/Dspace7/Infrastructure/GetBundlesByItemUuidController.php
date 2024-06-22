<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetBundlesByItemUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\BundleRequests;

final class GetBundlesByItemUuidController
{    
    private $bundleRequests;
    public function __construct()
    {
        $this->bundleRequests = new BundleRequests();
    }
    public function handler(string $itemUuid, ?int $page)
    {
        return (new GetBundlesByItemUseCase($this->bundleRequests))->handler($itemUuid,($page ?? 0)); 
    }
}
