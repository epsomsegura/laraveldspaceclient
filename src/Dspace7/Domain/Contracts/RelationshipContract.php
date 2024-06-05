<?php
declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Relationship;

interface RelationshipContract
{
    public function create($relationType, $uuids) : ?Relationship;
}