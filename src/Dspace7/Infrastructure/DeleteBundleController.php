<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\DeleteBundleUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\BundleRequests;

final class DeleteBundleController
{
    private $bundleRequests;
    public function __construct()
    {
        $this->bundleRequests = new BundleRequests();
    }
    public function handler(string $uuid)
    {
        return (new DeleteBundleUseCase($this->bundleRequests))->handler($uuid);
    }
}
