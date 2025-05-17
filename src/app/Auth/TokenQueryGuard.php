<?php

namespace App\Auth;

use Illuminate\Contracts\Auth\Guard;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Contracts\Auth\UserProvider;
use Illuminate\Http\Request;

class TokenQueryGuard implements Guard
{
    protected $request;
    protected $provider;
    protected $user;

    public function __construct(UserProvider $provider, Request $request)
    {
        $this->provider = $provider;
        $this->request = $request;
        $this->user = null;
    }

    public function user(): ?Authenticatable
    {
        if ($this->user !== null) {
            return $this->user;
        }

        $token = $this->request->query('token');

        if (!$token) {
            return null;
        }

        $this->user = $this->provider->retrieveByToken(null, $token);

        return $this->user;
    }

    public function check(): bool
    {
        return $this->user() !== null;
    }

    public function guest(): bool
    {
        return !$this->check();
    }

    public function id()
    {
        $user = $this->user();

        return $user ? $user->getAuthIdentifier() : null;
    }

    public function validate(array $credentials = []): bool
    {
        // Implementação simples que não usa validação tradicional
        return false;
    }

    public function setUser(Authenticatable $user)
    {
        $this->user = $user;

        return $this;
    }

    public function hasUser(): bool
    {
        return $this->user !== null;
    }
}
