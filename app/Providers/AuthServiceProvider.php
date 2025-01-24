<?php

namespace App\Providers;


use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(Gate $gate)
    {

        Gate::define('moderator', function ($user) {
            return $user->role === 'moderator';
        });

        Gate::define('view-home', function ($user) {
            return $user->role === 'hrd'; // Example condition
        });

        Gate::define('view-home', function ($user) {
            return $user->role === 'jppstm'; // or update to another role like 'admin'
        });

        


    }


}
