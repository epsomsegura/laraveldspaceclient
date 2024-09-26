<?php
declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\ResourcePolicy;

interface ResourcePolicyContract
{
    public function findAllByBitstreamUuid(string $bitstreamUUID, int $page) : array;
}