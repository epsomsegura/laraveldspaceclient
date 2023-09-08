<?php

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Domain;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Exceptions\BadCredentialsException;
use Epsomsegura\Laraveldspaceclient\Shared\Domain\EmailValidator;
use Epsomsegura\Laraveldspaceclient\Shared\Domain\UrlValidator;

class Credentials
{
    private ?string $url;
    private ?string $email;
    private ?string $pass;
    private EmailValidator $emailValidator;
    private UrlValidator $urlValidator;

    public function __construct()
    {
        $this->email = config('laravel-dspace-client.dspace_api_email');
        $this->pass = config('laravel-dspace-client.dspace_api_pass');
        $this->url = config('laravel-dspace-client.dspace_api_url');

        $this->emailValidator = new EmailValidator($this->email);
        $this->urlValidator = new UrlValidator($this->url);

        $this->errorHandler();
    }

    public function email(): ?string
    {
        return $this->email;
    }
    public function pass(): ?string
    {
        return $this->pass;
    }
    public function url(): ?string
    {
        return $this->url;
    }

    protected function errorHandler()
    {
        if (empty($this->email) && empty($this->pass) && empty($this->url)) {
            throw BadCredentialsException::emptyCredentials();
        }

        if (!empty($this->validationsMessage())) {
            throw BadCredentialsException::invalidData(implode(" - ", $this->validationsMessage()));
        }

        if (!$this->urlValidator->urlExists()) {
            throw BadCredentialsException::urlNotWorking($this->url);
        }
    }

    protected function validationsMessage(): array
    {
        $validationsMessage = [];
        if (!$this->emailValidator->isValid()) {
            $validationsMessage[] = $this->emailValidator->invalidMessage();
        }
        if (!$this->urlValidator->isValid()) {
            $validationsMessage[] = $this->urlValidator->invalidMessage();
        }
        return $validationsMessage;
    }
}
