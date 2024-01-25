<?php
declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Community;

interface CommunityContract
{
    public function create($community) : ?Community;
    public function createWithParent($community,string $communityParentUUID) : ?Community;
    public function delete($uuid) : string;
    public function findAll(int $page) : array;
    public function findAllIsParent(int $page) : array;
    public function findAllWhereName(string $name,int $page) : array;
    public function findAllWhereParent(string $communityParentUUID,int $page) : array;
    public function findOneByUUID(string $uuid) : ?Community;
    public function findOneByHandle(string $handle) : ?Community;
    public function findOneByName(string $name) : ?Community;
    public function update($community, string $uuid) : ?Community;
}