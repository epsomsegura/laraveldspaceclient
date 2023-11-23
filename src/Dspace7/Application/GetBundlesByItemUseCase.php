<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Application;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Collection;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts\BundleContract;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts\ItemContract;

final class GetBundlesByItemUseCase
{
    private $bundleContract;
    public function __construct(
        BundleContract $bundleContract
    ) {
        $this->bundleContract = $bundleContract;
    }
    public function handler(string $itemUUID): array
    {
        return $this->bundleContract->findAllByItemUUID($itemUUID);
    }
}
