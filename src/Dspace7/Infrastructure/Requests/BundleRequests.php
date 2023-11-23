<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts\BundleContract;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Exceptions\BundleExceptions;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Bundle;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Metadata;
use Epsomsegura\Laraveldspaceclient\Shared\Infrastructure\GuzzleRequester;

final class BundleRequests implements BundleContract
{
    private $requester;

    public function __construct()
    {
        $this->requester = new GuzzleRequester();
    }

    public function create($bundle, string $itemUUID): ?Bundle
    {
        $bundle = $this->requester->setMethod('post')->setEndpoint('core/items/'.$itemUUID.'/bundles')->setBody(json_encode($bundle))->setHeaders(['Content-Type' => 'application/json'])->request();
        dd($bundle);
        return new Bundle(
            $bundle->id,
            $bundle->uuid,
            $bundle->name,
            $bundle->handle,
            Metadata::arrayToMetadataArray(json_decode(json_encode($bundle->metadata), TRUE)),
            $bundle->type
        );
    }
    public function delete($uuid): string
    {
        $this->requester->setMethod('delete')->setEndpoint('core/bundles/' . $uuid)->setHeaders(['Content-Type' => 'application/json'])->request();
        return "success";
    }
    public function findAllByItemUUID(string $itemUUID) : array
    {
        $bundles = $this->requester->setMethod('get')->setEndpoint('core/items/'.$itemUUID.'/bundles')->request();
        if (!array_key_exists('_embedded', get_object_vars($bundles))) {
            throw BundleExceptions::notFound();
        }
        $bundles = array_filter($bundles->_embedded->bundles, function($bundle){
            return ($bundle->type === "bundle");
        });
        return $this->getBundles($bundles);
    }
    public function findOneByUUID(string $uuid): ?Bundle
    {
        $bundle = $this->requester->setMethod('get')->setEndpoint('core/bundles/' . $uuid)->request();
        return $this->getBundles([$bundle])[0];
    }
    private function getBundles(array $bundles): array
    {
        $uniqueBundles = [];
        foreach ($bundles as $bundle) {
            $bundle = (is_array($bundle) ? (object)$bundle : (property_exists($bundle,"_embedded") ? $bundle->_embedded->indexableObject : $bundle));
            $uniqueBundles[] = new Bundle(
                $bundle->uuid,
                $bundle->uuid,
                $bundle->name,
                $bundle->handle,
                Metadata::arrayToMetadataArray(json_decode(json_encode($bundle->metadata), TRUE)),
                $bundle->type
            );
        }
        return $uniqueBundles;
    }
}