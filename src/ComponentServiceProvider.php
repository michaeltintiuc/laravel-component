<?php
namespace MichaelT\Component;

use Illuminate\Support\ServiceProvider;

/**
 * Component ServiceProvider
 *
 * @package michaeltintiuc/laravel-permy
 * @author Michael Tintiuc
 */
class ComponentServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                MichaelT\Component\Commands\ComponentMakeCommand::class
            ]);
        }
    }
}
