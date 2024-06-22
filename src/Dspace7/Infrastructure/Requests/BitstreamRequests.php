<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts\BitstreamContract;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Bitstream;
use Epsomsegura\Laraveldspaceclient\Shared\Infrastructure\GuzzleRequester;

final class BitstreamRequests implements BitstreamContract
{
    private $requester;

    public function __construct()
    {
        $this->requester = new GuzzleRequester();
    }

    public function create($filestream, $filename, $contentType, $bundleUUID): ?Bitstream
    {        
        $bitstream = $this->requester->setMethod('post')->setEndpoint('core/bundles/'.$bundleUUID.'/bitstreams')->setMultipart([
            [
                'name' => 'file',
                'contents' => $filestream,
                'filename' => $filename,
                'Content-type' => $contentType
            ]
        ])->setHeaders(null)->request();                
        return new Bitstream(
            $bitstream->uuid,
            $bitstream->name,
            $bitstream->handle,
            $bitstream->metadata,
            $bitstream->sizeBytes,
            $bitstream->checkSum,
            $bitstream->sequenceId,
            $bitstream->type,
        );
    } 
}