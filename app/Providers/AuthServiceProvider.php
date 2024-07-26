<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        
        Gate::define('view-users', function ($user) {
            return $user->type == 'ADMIN';
        });

        Gate::define('submit-form', function ($user) {
            return $user->type == 'ADMIN' ||
            $user->type == 'REPORTER'||
            $user->type == 'DEFAULT';
        });

        Gate::define('view-forms', function ($user) {
            return $user->type == 'ADMIN' ||
            $user->type == 'VIEWER'||
            $user->type == 'DEFAULT';
        });
    }
}
