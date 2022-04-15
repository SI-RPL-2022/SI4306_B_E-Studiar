<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    // public const HOME = '/home';

    // public const ADMIN = '/admin';

    protected $namespace = 'App\\Http\\Controllers';

    public function boot()
    {
        $this->registerPolicies();

        // $this->configureRateLimiting();

        // // $this->routes(function () {
        // Route::prefix('api')
        //     ->middleware('api')
        //     ->namespace($this->namespace)
        //     ->group(base_path('routes/api.php'));

        // Route::middleware('web')
        //     ->namespace($this->namespace)
        //     ->group(base_path('routes/web.php'));

        // //our custom route path
        // Route::middleware('web')
        //     ->namespace($this->namespace)
        //     ->group(base_path('routes/admin.php'));
        // });
    }

    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by(optional($request->user())->id ?: $request->ip());
        });
    }
}