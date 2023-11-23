<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Application;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts\BundleContract;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts\ItemContract;

final class DeleteBundleUseCase
{
    private $bundleContract;
    public function __construct(
        BundleContract $bundleContract
    ) {
        $this->bundleContract = $bundleContract;
    }
    public function handler($uuid): string
    {
        return $this->bundleContract->delete($uuid);
    }
}
