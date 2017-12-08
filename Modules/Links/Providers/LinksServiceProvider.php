<?php

namespace Modules\Links\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Links\Events\Handlers\RegisterLinksSidebar;

class LinksServiceProvider extends ServiceProvider
{
    use CanPublishConfiguration;
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
        $this->registerBindings();
        $this->app['events']->listen(BuildingSidebar::class, RegisterLinksSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('links', array_dot(trans('links::links')));
            // append translations

        });
    }

    public function boot()
    {
        $this->publishConfig('links', 'permissions');
        $this->publishConfig('links', 'config');
        $this->loadMigrationsFrom(__DIR__ . '/../Database/Migrations');
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Links\Repositories\LinksRepository',
            function () {
                $repository = new \Modules\Links\Repositories\Eloquent\EloquentLinksRepository(new \Modules\Links\Entities\Links());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Links\Repositories\Cache\CacheLinksDecorator($repository);
            }
        );
// add bindings

    }
}
