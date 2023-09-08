<?php 

declare(strict_types=1);

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure;

use Epsomsegura\Laraveldspaceclient\Dspace7\Application\GetCredentialsUseCase;
use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Credentials;
use Epsomsegura\Laraveldspaceclient\Dspace7\Infrastructure\Repository\CredentialsJsonOutput;

final class GetCredentialsController
{

    private $output;

    public function __construct(
        CredentialsJsonOutput $output,
    )
    {
        $this->output = $output;
    }

    public function __invoke()
    {
        return (new GetCredentialsUseCase($this->output))->handler();
    }

}