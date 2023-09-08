<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Repository;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts\CredentialsOutputContract;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Credentials;

final class CredentialsJsonOutput implements CredentialsOutputContract
{
    private $credentials;
    public function __construct(
        ?Credentials $credentials = new Credentials()
    )
    {
        $this->credentials = $credentials;
    }
    
    public function output(){
        return response()->json([
            "email" => $this->credentials->email(),
            "pass" => $this->credentials->pass(),
            "url" => $this->credentials->url(),
        ],200);
    }
}