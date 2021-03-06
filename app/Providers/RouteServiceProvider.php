<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiAdminRoutes();
        $this->mapApiJobSeekerRoutes();
        $this->mapApiEmployerRoutes();
        $this->mapApiAuthRoutes();
    }


    /**
     * Define the "backend" routes for the application.
     *
     * These routes all receive api .
     *
     * @return void
     */
    protected function mapApiAdminRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->domain(env('Admin_url'))
            ->namespace($this->namespace . '\Backend')
            ->group(base_path('routes/admin.php'));
    }

    /**
     * Define the "jobSeeker" routes for the application.
     *
     * These routes all receive api .
     *
     * @return void
     */
    protected function mapApiJobSeekerRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->domain(env('JOBSEEKER_URL'))
            ->namespace($this->namespace . '\JobSeeker')
            ->group(base_path('routes/jobSeeker.php'));
    }

    /**
     * Define the "Employer" routes for the application.
     *
     * These routes all receive api .
     *
     * @return void
     */
    protected function mapApiEmployerRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->domain(env('EMPLOYER_URL'))
            ->namespace($this->namespace . '\Employer')
            ->group(base_path('routes/employer.php'));
    }

    protected function mapApiAuthRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->domain(env('AUTH_URL'))
            ->namespace($this->namespace . '\Auth')
            ->group(base_path('routes/auth.php'));
    }

}
