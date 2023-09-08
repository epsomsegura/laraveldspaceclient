<?php

namespace Epsomsegura\Laraveldspaceclient\Shared\Domain;

class EmailValidator
{

    public ?string $email;
    
    public function __construct(?string $email) {
        $this->email = $email;
    }

    public function isValid()
    {
        return filter_var($this->email, FILTER_VALIDATE_EMAIL);
    }

    public function invalidMessage() : string
    {
        return "'".$this->email."' is not email string";
    }
}
