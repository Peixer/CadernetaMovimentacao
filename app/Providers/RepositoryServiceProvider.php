<?php

namespace Caderneta\Providers;

use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'Caderneta\Repositories\MovimentacoeRepository',
            'Caderneta\Repositories\MovimentacoeRepositoryEloquent');

        $this->app->bind(
            'Caderneta\Repositories\UserRepository',
            'Caderneta\Repositories\UserRepositoryEloquent');

    }
}
