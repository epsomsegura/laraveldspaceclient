<?php

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Application;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Contracts\CredentialsOutputContract;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Credentials;

final class GetCredentialsUseCase
{
    private $output;

    public function __construct(
        CredentialsOutputContract $output,
    )
    {
        $this->output = $output;
    }

    public function handler()
    {
        return $this->output->output();
    }
}
