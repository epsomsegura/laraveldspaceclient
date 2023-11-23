<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Application;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts\BundleContract;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts\ItemContract;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Item;

final class GetBundleByUUIDUseCase
{
    private $bundleContract;
    public function __construct(
        BundleContract $bundleContract
    ) {
        $this->bundleContract = $bundleContract;
    }
    public function handler(string $uuid): ?Item
    {
        return $this->bundleContract->findOneByUUID($uuid);
    }
}
