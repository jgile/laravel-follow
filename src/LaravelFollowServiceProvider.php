<?php

namespace Jgile\LaravelFollow;

use Illuminate\Support\ServiceProvider;
use Illuminate\Routing\Router;

class LaravelFollowServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Router $router)
    {
        $router->aliasMiddleware('LaravelFollow', \Jgile\LaravelFollow\Middleware\LaravelFollowMiddleware::class);

        $this->publishes([
            __DIR__.'/Config/LaravelFollow.php' => config_path('LaravelFollow.php'),
        ], 'LaravelFollow_config');

        $this->loadRoutesFrom(__DIR__ . '/Routes/web.php');

        $this->loadMigrationsFrom(__DIR__ . '/Migrations');

        $this->loadTranslationsFrom(__DIR__ . '/Translations', 'LaravelFollow');

        $this->publishes([
            __DIR__ . '/Translations' => resource_path('lang/vendor/LaravelFollow'),
        ]);

        $this->loadViewsFrom(__DIR__ . '/Views', 'LaravelFollow');

        $this->publishes([
            __DIR__ . '/Views' => resource_path('views/vendor/LaravelFollow'),
        ]);

        $this->publishes([
            __DIR__ . '/Assets' => public_path('vendor/LaravelFollow'),
        ], 'LaravelFollow_assets');

        if ($this->app->runningInConsole()) {
            $this->commands([
                \Jgile\LaravelFollow\Commands\LaravelFollowCommand::class,
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(
            __DIR__ . '/Config/LaravelFollow.php', 'LaravelFollow'
        );
    }
}
