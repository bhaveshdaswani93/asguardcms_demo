<?php

namespace Modules\Leavemanagement\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Leavemanagement\Events\Handlers\RegisterLeavemanagementSidebar;

class LeavemanagementServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterLeavemanagementSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('leavemanagements', array_dot(trans('leavemanagement::leavemanagements')));
            // append translations

        });
    }

    public function boot()
    {
        $this->publishConfig('leavemanagement', 'permissions');

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
            'Modules\Leavemanagement\Repositories\LeavemanagementRepository',
            function () {
                $repository = new \Modules\Leavemanagement\Repositories\Eloquent\EloquentLeavemanagementRepository(new \Modules\Leavemanagement\Entities\Leavemanagement());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Leavemanagement\Repositories\Cache\CacheLeavemanagementDecorator($repository);
            }
        );
// add bindings

    }
}
