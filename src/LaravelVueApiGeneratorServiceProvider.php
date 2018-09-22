<?php

namespace Koga1020\LaravelVueApiGenerator;

use Illuminate\Support\ServiceProvider;

class LaravelVueApiGeneratorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\GenerateCommand::class
            ]);
        }
    }
}
