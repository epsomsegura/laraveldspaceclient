<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetResourcePoliciesByBitstreamUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\ResourcePolicyRequests;

final class GetResourcePoliciesByBitstreamUuidController
{
    private $resourcePolicyRequests;
    public function __construct()
    {
        $this->resourcePolicyRequests = new ResourcePolicyRequests();
    }
    public function handler(string $bitstreamUUID, ?int $page)
    {
        return (new GetResourcePoliciesByBitstreamUseCase($this->resourcePolicyRequests))->handler($bitstreamUUID,($page ?? 0));
    }
}
