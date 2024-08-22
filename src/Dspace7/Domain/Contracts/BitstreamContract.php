<?php
declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Bitstream;

interface BitstreamContract
{
    public function create($filestream, $filename, $contentType, $bundleUUID) : ?Bitstream;
    public function findAllByBundleUUID(string $bundleUUID, int $page) : array;
}