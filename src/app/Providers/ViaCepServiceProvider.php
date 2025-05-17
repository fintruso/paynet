<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\CepService;
use App\Auth\TokenQueryGuard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

class ViaCepServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Registra CepService com injeção automática
        $this->app->singleton(CepService::class, fn() => new CepService());
    }

    public function boot(): void
    {
        Auth::extend('token_query', function ($app, $name, array $config) {
            $provider = Auth::createUserProvider($config['provider']);
    
            return new TokenQueryGuard($provider, request());
        });
    }
}
