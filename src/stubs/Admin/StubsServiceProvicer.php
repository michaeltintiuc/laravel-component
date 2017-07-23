<?php
namespace App\Components\Stubs\Admin;

use Illuminate\Support\ServiceProvider;

class StubsServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(StubsRepoContract::class, StubsRepo::class);
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [StubsRepoContract::class];
    }
}
