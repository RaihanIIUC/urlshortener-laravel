<?php

namespace App\Providers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     *
     * @return void
     */
    public function boot()
    {
        $this->configureRateLimiting();

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }

    /**
     * Configure the rate limiters for the application.
     *
     * @return void
     */
    protected function configureRateLimiting()
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        RateLimiter::for('ip_banning', function (Request $request) {
           return Limit::perMinute(3)->by($request->ip())->response(function ($request) {

                $users = User::where('ip', $request->ip())->first();
                $success['curr_date'] =  Carbon::now()->addMinutes(5);
                $curr_date =  Carbon::now()->addMinutes(5);
               

                 if (now()->lessThan($users->banned_until)) {
                     $success['banned_mins'] = now()->diffInMinutes($users->banned_until);

                    return $this->sendResponse($success, 'Your are banned for 5 mins.');
                } else {
                    $users->update([
                        'banned_until' => $curr_date
                    ]);
                    $success['now'] = 4;
                    return $this->sendResponse($success, 'Your are banned for temp mins.');
                }
                return $this->sendResponse($success, 'Your are banned for demo mins.');

            });
        });
    }
}
