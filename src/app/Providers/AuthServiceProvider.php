<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    public function boot(): void
    {
        $this->registerPolicies();

        // Aqui você registra o driver personalizado
        Auth::extend('token_query', function ($app, $name, array $config) {
            return new \App\Auth\TokenQueryGuard(
                Auth::createUserProvider($config['provider']),
                $app['request']
            );
        });
    }
}
