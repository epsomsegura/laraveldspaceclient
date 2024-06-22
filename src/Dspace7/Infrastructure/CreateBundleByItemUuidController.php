<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\CreateBundleUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\BundleRequests;

final class CreateBundleByItemUuidController
{
    private $bundleRequests;    
    public function __construct()
    {
        $this->bundleRequests = new BundleRequests();
    }
    public function handler(array $bundle, string $itemUuid)
    {
        return (new CreateBundleUseCase($this->bundleRequests))->handler($bundle, $itemUuid);
    }
}
