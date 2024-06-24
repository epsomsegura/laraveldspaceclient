<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\CreateBitstreamUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Application\CreateBundleUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetBundlesByItemUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\BitstreamRequests;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests\BundleRequests;

final class CreateBitstreamByItemUuidController
{
    private $bitstreamRequests;    
    private $bundleRequests;    
    public function __construct()
    {
        $this->bitstreamRequests = new BitstreamRequests();
        $this->bundleRequests = new BundleRequests();
    }
    public function handler($filestream, $filename, $contentType, string $itemUuid, string $bundleName)
    {
        $bundles = (new GetBundlesByItemUseCase($this->bundleRequests))->handler($itemUuid, 0);
        $bundle = array_filter($bundles['elements'], function ($bundle) use ($bundleName) {
            return $bundle->name === $bundleName;
        });
        if(empty($bundle)){
            $bundle = (new CreateBundleUseCase($this->bundleRequests))->handler([
                "name" => $bundleName,
                "metadata" => new \stdClass
            ], $itemUuid);
            return (new CreateBitstreamUseCase($this->bitstreamRequests))->handler($filestream, $filename, $contentType, $bundle->uuid());
        }else{
            $bundle = array_shift($bundle);
            return (new CreateBitstreamUseCase($this->bitstreamRequests))->handler($filestream, $filename, $contentType, $bundle->uuid);
        }
    }
}
