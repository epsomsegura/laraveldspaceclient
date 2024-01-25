<?php

namespace Epsomsegura\Laraveldspaceclient\Traits;

use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\CreateCollectionController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\CreateCommunityController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\CreateCommunityWithParentController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\CreateItemController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\GetCollectionsByCommunityController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\GetCommunitiesIsParentController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\GetCommunitiesWhereNameController;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\GetCommunitiesWhereParentController;

trait LaravelDspaceClientTrait
{
    public $useBootstrap = false;
    public $selectedCommunity = "";
    public $selectedSubcommunity;
    public $selectedCollection;

    public function getCommunities(int $page): array
    {
        return (new GetCommunitiesIsParentController)->handler($page);
    }
    public function getCommunitiesByName(int $page, string $filter): array
    {
        return (new GetCommunitiesWhereNameController)->handler($filter,$page);
    }
    public function getSubcommunities(string $communityParentName, int $page): array
    {
        return (new GetCommunitiesWhereParentController)->handler($communityParentName, $page);
    }
    public function getCollections(string $communityName, int $page): array
    {
        return (new GetCollectionsByCommunityController)->handler($communityName, $page);
    }

    public function createCommunity(string $name): array
    {
        return (new CreateCommunityController)->handler($this->community($name))->toArray();
    }

    public function createSubcommunity(string $name, string $communityParentName): array
    {
        return (new CreateCommunityWithParentController)->handler($communityParentName, $this->community($name))->toArray();
    }

    public function createCollection(string $name, string $communityName): array
    {
        $collection = [
            "name" => $name,
            "metadata" => [
                "dc.title" => [
                    [
                        "value" => $name,
                        "language" => null,
                        "authority" => null,
                        "confidence" => -1
                    ]
                ]
            ]
        ];
        return (new CreateCollectionController)->handler($collection,$communityName)->toArray();
    }

    private function community(string $name): array
    {
        return [
            "name" => $name,
            "metadata" => [
                "dc.title" => [
                    [
                        "value" => $name,
                        "language" => null,
                        "authority" => null,
                        "confidence" => -1
                    ]
                ]
            ]
        ];
    }
}
