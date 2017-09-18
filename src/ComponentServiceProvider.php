<?php
namespace MichaelT\Component;

use Illuminate\Support\ServiceProvider;
use MichaelT\Component\Commands\ComponentMakeCommand;

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
            $this->commands([ComponentMakeCommand::class]);
        }
    }
}
