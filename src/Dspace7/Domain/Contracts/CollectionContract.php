<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Collection;

interface CollectionContract
{
    public function create($collection, string $communityUUID): ?Collection;
    public function delete(string $uuid): string;
    public function findAll(int $page): array;
    public function findAllByCommunityUUID(string $communityUUID, int $page): array;
    public function findOneByUUID(string $uuid): ?Collection;
    public function findOneByHandle(string $handle): ?Collection;
    public function findOneByName(string $name): ?Collection;
    public function update(string $collection, string $uuid): ?Collection;
}
