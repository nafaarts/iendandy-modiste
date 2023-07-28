<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
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
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('is-admin', function ($user) {
            return $user->is_admin;
        });

        // http://localhost:7020/password/reset/d66bcf34140fe1381127b8634939ef3a2fbaab1ca25194c09e4cd847f8da2eea?email=nfalldh%40gmail.com
        ResetPassword::createUrlUsing(function (User $user, string $token) {
            return url('/password/reset/' . $token . '?email=' . $user->email);
        });
    }
}
