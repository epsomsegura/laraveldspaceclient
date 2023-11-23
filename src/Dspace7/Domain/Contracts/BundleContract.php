<?php
declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Bundle;

interface BundleContract
{
    public function create($bundle, string $itemUUID) : ?Bundle;
    public function delete(string $uuid) : string;
    public function findAllByItemUUID(string $itemUUID) : array;
    public function findOneByUUID(string $uuid) : ?Bundle;
}