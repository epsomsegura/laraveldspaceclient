<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetBitstreamsByBundleUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\BitstreamRequests;

final class GetBitstreamsByBundleUuidController
{
    private $bundleRequests;
    public function __construct()
    {
        $this->bundleRequests = new BitstreamRequests();
    }
    public function handler(string $itemUuid, ?int $page)
    {
        return (new GetBitstreamsByBundleUseCase($this->bundleRequests))->handler($itemUuid,($page ?? 0));
    }
}
