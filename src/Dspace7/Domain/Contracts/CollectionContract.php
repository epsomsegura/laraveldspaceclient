<?php
declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts;

interface CollectionContract
{
    
    public function findOneByName(string $name);
    
}