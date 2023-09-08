<?php

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Domain;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Exceptions\BadCredentialsException;

class Credentials
{
    public $dspaceApiUrl;
    public $dspaceApiUser;
    public $dspaceApiPass;

    public function __construct(
        ?string $dspaceApiUrl, 
        ?string $dspaceApiUser, 
        ?string $dspaceApiPass)
    {
        if(empty($dspaceApiUrl) && empty($dspaceApiUser) && empty($dspaceApiPass)){
            throw BadCredentialsException::create($dspaceApiUrl,$dspaceApiUser,$dspaceApiPass);
        }
        $this->dspaceApiUrl = $dspaceApiUrl;
        $this->dspaceApiUser = $dspaceApiUser;
        $this->dspaceApiPass = $dspaceApiPass;
        
    }



}