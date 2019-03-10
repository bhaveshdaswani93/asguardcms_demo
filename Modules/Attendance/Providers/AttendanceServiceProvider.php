<?php

namespace Modules\Attendance\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Core\Traits\CanPublishConfiguration;
use Modules\Core\Events\BuildingSidebar;
use Modules\Core\Events\LoadingBackendTranslations;
use Modules\Attendance\Events\Handlers\RegisterAttendanceSidebar;

class AttendanceServiceProvider extends ServiceProvider
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
        $this->app['events']->listen(BuildingSidebar::class, RegisterAttendanceSidebar::class);

        $this->app['events']->listen(LoadingBackendTranslations::class, function (LoadingBackendTranslations $event) {
            $event->load('attendances', array_dot(trans('attendance::attendances')));
            // append translations

        });
    }

    public function boot()
    {
        $this->publishConfig('attendance', 'permissions');

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
            'Modules\Attendance\Repositories\AttendanceRepository',
            function () {
                $repository = new \Modules\Attendance\Repositories\Eloquent\EloquentAttendanceRepository(new \Modules\Attendance\Entities\Attendance());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Attendance\Repositories\Cache\CacheAttendanceDecorator($repository);
            }
        );
// add bindings

    }
}
