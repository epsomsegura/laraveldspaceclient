<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Requests;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts\BitstreamContract;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Exceptions\BitstreamExceptions;
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

    public function findAllByBundleUUID(string $itemUUID, int $page) : array
    {
        $response = $this->requester->setMethod('get')->setEndpoint('core/bundles/'.$itemUUID.'/bitstreams')->setQuery(["page" => $page])->request();
        if (!array_key_exists('_embedded', get_object_vars($response))) {
            throw BitstreamExceptions::notFound();
        }
        $bitstreams = array_filter($response->_embedded->bitstreams, function($bitstream){
            return ($bitstream->type === "bitstream");
        });
        return ["elements" => $bitstreams, "page" => $response->page];
    }
}