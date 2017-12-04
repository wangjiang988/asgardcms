<?php

namespace Modules\Testimonials\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Testimonials\Events\Handlers\RegisterTestimonialsSidebar;

class TestimonialsServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterTestimonialsSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('testimonials', array_dot(trans('testimonials::testimonials')));
            // append translations

        });
    }

    public function boot()
    {
        $this->publishConfig('testimonials', 'permissions');

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
            'Modules\Testimonials\Repositories\TestimonialRepository',
            function () {
                $repository = new \Modules\Testimonials\Repositories\Eloquent\EloquentTestimonialRepository(new \Modules\Testimonials\Entities\Testimonial());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Testimonials\Repositories\Cache\CacheTestimonialDecorator($repository);
            }
        );
// add bindings

    }
}
