<?php
declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Item;

interface ItemContract
{
    public function create($item, string $collectionId);
    
    public function findOneByHandle(string $handle);
    
}