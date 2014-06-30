<?php namespace Laracasts\Flash;

use Illuminate\Support\ServiceProvider;

class FlashServiceProvider extends ServiceProvider {

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            'Laracasts\Flash\SessionStore',
            'Laracasts\Flash\LaravelSessionStore'
        );

        $this->app->bindShared('flash', function()
        {
            return $this->app->make('Laracasts\Flash\FlashNotifier');
        });
    }

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('laracasts/flash');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['flash'];
    }

}
