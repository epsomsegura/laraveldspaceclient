<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Community;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts\CommunityContract;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Exceptions\CommunityExceptions;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Metadata;
use Epsomsegura\Laraveldspaceclient\Shared\Infrastructure\GuzzleRequester;

final class CommunityRequests implements CommunityContract
{
    private $requester;

    public function __construct()
    {
        $this->requester = new GuzzleRequester();
    }

    public function create($community): ?Community
    {
        $community = $this->requester->setMethod('post')->setEndpoint('core/communities')->setBody(json_encode($community))->setHeaders(['Content-Type' => 'application/json'])->request();
        return new Community(
            $community->id,
            $community->uuid,
            $community->name,
            $community->handle,
            Metadata::arrayToMetadataArray(json_decode(json_encode($community->metadata), TRUE))
        );
    }
    public function createWithParent($community,$communityParentUUID): ?Community
    {
        $community = $this->requester->setMethod('post')->setEndpoint('core/communities')->setQuery(["parent"=>$communityParentUUID])->setBody(json_encode($community))->setHeaders(['Content-Type' => 'application/json'])->request();
        return new Community(
            $community->id,
            $community->uuid,
            $community->name,
            $community->handle,
            Metadata::arrayToMetadataArray(json_decode(json_encode($community->metadata), TRUE))
        );
    }
    public function delete($uuid): string
    {
        $this->requester->setMethod('delete')->setEndpoint('core/communities/' . $uuid)->setHeaders(['Content-Type' => 'application/json'])->request();
        return "success";
    }

    public function findAll(): array
    {
        $communities = $this->requester->setMethod('get')->setEndpoint('core/communities')->request();
        if (!array_key_exists('_embedded', get_object_vars($communities))) {
            throw CommunityExceptions::notFound();
        }
        return $this->getCommunities($communities->_embedded->communities);
    }
    public function findAllIsParent(): array
    {
        $communities = $this->requester->setMethod('get')->setEndpoint('core/communities/search/top')->request();
        if (!array_key_exists('_embedded', get_object_vars($communities))) {
            throw CommunityExceptions::notFound();
        }
        return $this->getCommunities($communities->_embedded->communities);
    }
    public function findAllWhereParent(string $communityParentUUID): array
    {
        $subcommunities = $this->requester->setMethod('get')->setEndpoint('core/communities/'.$communityParentUUID.'/subcommunities')->request();
        if (!array_key_exists('_embedded', get_object_vars($subcommunities))) {
            throw CommunityExceptions::notFound();
        }
        return $this->getCommunities($subcommunities->_embedded->subcommunities);
    }
    public function findOneByUUID(string $uuid): Community
    {
        $community = $this->requester->setMethod('get')->setEndpoint('core/communities/' . $uuid)->request();
        return $this->getCommunities([$community])[0];
    }

    public function findOneByHandle(string $handle): Community
    {
        $communities = $this->requester->setMethod('get')->setEndpoint('core/communities/search/findAdminAuthorized')->setQuery(["query" => $handle])->request();
        if (!array_key_exists('_embedded', get_object_vars($communities))) {
            throw CommunityExceptions::notFound();
        }
        $communities = array_filter($communities->_embedded->communities, function ($community) use ($handle) {
            return ($community->handle === $handle && $community->type === "community");
        });
        if (sizeof($communities) <= 0) {
            throw CommunityExceptions::empty();
        }
        return $this->getCommunities($communities)[0];
    }

    public function findOneByName(string $name): Community
    {
        $communities = $this->requester->setMethod('get')->setEndpoint('core/communities/search/findAdminAuthorized')->setQuery(["query" => $name])->request();
        if (!array_key_exists('_embedded', get_object_vars($communities))) {
            throw CommunityExceptions::notFound();
        }
        $communities = array_filter($communities->_embedded->communities, function ($community) use ($name) {
            return ($community->name === $name && $community->type === "community");
        });
        if (sizeof($communities) <= 0) {
            throw CommunityExceptions::empty();
        }
        return $this->getCommunities($communities)[0];
    }

    public function update($community, string $uuid): Community
    {
        $community = $this->requester->setMethod('put')->setEndpoint('core/communities/' . $uuid)->setBody(json_encode($community))->setHeaders(['Content-Type' => 'application/json'])->request();
        return new Community(
            $community->id,
            $community->uuid,
            $community->name,
            $community->handle,
            Metadata::arrayToMetadataArray(json_decode(json_encode($community->metadata), TRUE))
        );
    }

    private function getCommunities(array $communities)
    {
        $uniqueCommunities = [];
        foreach ($communities as $community) {
            $uniqueCommunities[] = new Community(
                $community->id,
                $community->uuid,
                $community->name,
                $community->handle,
                Metadata::arrayToMetadataArray(json_decode(json_encode($community->metadata), TRUE)),
            );
        }
        return $uniqueCommunities;
    }
}
