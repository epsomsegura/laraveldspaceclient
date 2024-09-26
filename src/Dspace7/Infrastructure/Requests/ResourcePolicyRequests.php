<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts\ResourcePolicyContract;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Exceptions\ResourcePolicyExceptions;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\ResourcePolicy;
use Epsomsegura\Laraveldspaceclient\Shared\Infrastructure\GuzzleRequester;

final class ResourcePolicyRequests implements ResourcePolicyContract
{
    private $requester;

    public function __construct()
    {
        $this->requester = new GuzzleRequester();
    }

    public function findAllByBitstreamUuid($bitstreamUUID, $page): array
    {
        $response = $this->requester->setMethod('get')->setEndpoint('authz/resourcepolicies/search/resource')->setQuery(["uuid" => $bitstreamUUID, "page" => $page])->request();
        if (!array_key_exists('_embedded', get_object_vars($response))) {
            throw ResourcePolicyExceptions::empty();
        }
        $resourcePolicies = array_filter($response->_embedded->resourcepolicies, function($resourcePolicy){
            return ($resourcePolicy->type === "resourcepolicy");
        });
        return ["elements" => $resourcePolicies, "page" => $response->page];
    }
}
