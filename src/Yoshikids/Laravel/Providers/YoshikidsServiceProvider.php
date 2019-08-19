<?php

namespace Yoshikids\Laravel\Providers;

use Reliese\Coders\CodersServiceProvider;
use Illuminate\Filesystem\Filesystem;
use Reliese\Coders\Model\Config;
use Reliese\Support\Classify;
use Yoshikids\Laravel\Console\Models;
use Yoshikids\Laravel\Model\Factory;

class YoshikidsServiceProvider extends CodersServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../../../../config/models.php' => config_path('models.php'),
            ], 'yoshikids-models');

            $this->commands([
                Models::class,
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
        $this->registerModelFactory();
    }

    /**
     * Register Model Factory.
     *
     * @return void
     */
    protected function registerModelFactory()
    {
        $this->app->singleton(Factory::class, function ($app) {
            return new Factory(
                $app->make('db'),
                $app->make(FileSystem::class),
                new Classify(),
                new Config($app->make('config')->get('models'))
            );
        });
    }

    /**
     * @return array
     */
    public function provides()
    {
        return [Factory::class];
    }
}
