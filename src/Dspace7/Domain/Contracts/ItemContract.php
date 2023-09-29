<?php
declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts;

interface ItemContract
{
    
    public function findOneByHandle(string $handle);
    
}