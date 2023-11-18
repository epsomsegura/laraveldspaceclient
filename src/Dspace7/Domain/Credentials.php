<?php

namespace Epsomsegura\Laraveldspaceclient\Dspace7\Domain;

use Epsomsegura\Laraveldspaceclient\Dspace7\Domain\Exceptions\BadCredentialsException;
use Epsomsegura\Laraveldspaceclient\Shared\Domain\EmailValidator;
use Epsomsegura\Laraveldspaceclient\Shared\Domain\UrlValidator;

class Credentials
{
    private ?string $email;
    private ?string $pass;
    private ?string $url;
    private ?string $domain;
    private EmailValidator $emailValidator;
    private UrlValidator $urlValidator;
    public function __construct(
        ?string $email = null,
        ?string $pass = null,
        ?string $url = null,
        ?string $domain = null
    ) {
        $this->email = $email;
        $this->pass = $pass;
        $this->url = $url;
        $this->domain = $domain;

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
    public function domain(): ?string
    {
        return $this->domain;
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
