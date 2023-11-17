<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Collection;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts\CollectionContract;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Exceptions\CollectionExceptions;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Metadata;
use Epsomsegura\Laraveldspaceclient\Shared\Infrastructure\GuzzleRequester;

final class CollectionRequests implements CollectionContract
{
    private $requester;

    public function __construct()
    {
        $this->requester = new GuzzleRequester();
    }

    public function create($collection, string $communityUUID): ?Collection
    {
        $collection = $this->requester->setMethod('post')->setEndpoint('core/collections')->setQuery(["parent" => $communityUUID])->setBody(json_encode($collection))->setHeaders(['Content-Type' => 'application/json'])->request();
        return new Collection(
            $collection->id,
            $collection->uuid,
            $collection->name,
            $collection->handle,
            Metadata::arrayToMetadataArray(json_decode(json_encode($collection->metadata), TRUE))
        );
    }
    public function delete($uuid): string
    {
        $this->requester->setMethod('delete')->setEndpoint('core/collections/' . $uuid)->setHeaders(['Content-Type' => 'application/json'])->request();
        return "success";
    }

    public function findAll(): array
    {
        $collections = $this->requester->setMethod('get')->setEndpoint('core/collections')->request();
        if (!array_key_exists('_embedded', get_object_vars($collections))) {
            throw CollectionExceptions::notFound();
        }
        if (sizeof($collections->_embedded->collections) <= 0) {
            throw CollectionExceptions::empty();
        }
        return $this->getCollections($collections->_embedded->collections);
    }
    public function findAllByCommunityUUID(string $communityUUID) : array
    {
        $collections = $this->requester->setMethod('get')->setEndpoint('core/communities/'.$communityUUID.'/collections')->request();
        if (!array_key_exists('_embedded', get_object_vars($collections))) {
            throw CollectionExceptions::notFound();
        }
        if (sizeof($collections->_embedded->collections) <= 0) {
            throw CollectionExceptions::empty();
        }
        return $this->getCollections($collections->_embedded->collections);
    }
    public function findOneByHandle(string $handle): Collection
    {
        $collections = $this->requester->setMethod('get')->setEndpoint('core/collections/search/findAdminAuthorized')->setQuery(["query" => $handle])->request();
        if (!array_key_exists('_embedded', get_object_vars($collections))) {
            throw CollectionExceptions::notFound();
        }
        $collections = array_filter($collections->_embedded->collections,function($collection) use ($handle){
            return ($collection->handle === $handle && $collection->type === "collection");
        });
        if (sizeof($collections) <= 0) {
            throw CollectionExceptions::empty();
        }
        return $this->getCollections($collections)[0];
    }
    public function findOneByUUID(string $uuid): Collection
    {
        $collection = $this->requester->setMethod('get')->setEndpoint('core/collections/' . $uuid)->request();
        return $this->getCollections([$collection])[0];
    }
    public function findOneByName(string $name): Collection
    {
        $collections = $this->requester->setMethod('get')->setEndpoint('core/collections/search/findAdminAuthorized')->setQuery(["query" => $name])->request();
        if (!array_key_exists('_embedded', get_object_vars($collections))) {
            throw CollectionExceptions::notFound();
        }
        $collections = array_filter($collections->_embedded->collections,function($collection) use ($name){
            return ($collection->name === $name && $collection->type === "collection");
        });
        if (sizeof($collections) <= 0) {
            throw CollectionExceptions::empty();
        }
        return $this->getCollections($collections)[0];
    }

    public function update($collection, string $uuid): Collection
    {
        $collection = $this->requester->setMethod('put')->setEndpoint('core/collections/' . $uuid)->setBody(json_encode($collection))->setHeaders(['Content-Type' => 'application/json'])->request();
        return new Collection(
            $collection->id,
            $collection->uuid,
            $collection->name,
            $collection->handle,
            Metadata::arrayToMetadataArray(json_decode(json_encode($collection->metadata), TRUE))
        );
    }

    private function getCollections(array $collections) : array
    {
        $uniqueCollections = [];
        foreach ($collections as $collection) {
            $uniqueCollections[] = new Collection(
                $collection->id,
                $collection->uuid,
                $collection->name,
                $collection->handle,
                Metadata::arrayToMetadataArray(json_decode(json_encode($collection->metadata),TRUE)),
            );
        }
        return $uniqueCollections;
    }
}
