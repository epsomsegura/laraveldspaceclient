<?php
declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Item;

interface ItemContract
{
    public function create($item, string $collectionUUID) : ?Item;
    public function delete(string $uuid) : string;
    public function findAll() : array;
    public function findOneByHandle(string $handle) : ?Item;
    public function findOneByName(string $name) : ?Item;
    public function findOneByUUID(string $uuid) : Item;
    public function update($item, string $uuid) : ?Item;
}