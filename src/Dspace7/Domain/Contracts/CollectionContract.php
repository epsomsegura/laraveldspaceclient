<?php
declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Collection;

interface CollectionContract
{
    public function findOneByName(string $name) : Collection;
}