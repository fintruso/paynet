<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;

class PasswordResetRequested
{
    use Dispatchable;

    public string $email;
    public string $token;

    public function __construct(string $email, string $token)
    {
        $this->email = $email;
        $this->token = $token;
    }
}