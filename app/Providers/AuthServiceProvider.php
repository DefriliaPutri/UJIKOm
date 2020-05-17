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

        Gate::define('manage-users', function($user){
            return $user->roles == 'admin';
            });
            Gate::define('manage-outlets', function($user){
                return $user->roles == 'admin';
            });
            Gate::define('manage-members', function($user){
                return $user->roles == 'admin' && 'kasir'; 
            });
            Gate::define('manage-paket', function($user){
                return count(array_intersect(["admin", "kasir"], json_decode($user->roles)));
            });
            Gate::define('manage-transaksi', function($user){
                return count(array_intersect(["admin", "kasir", "owner"], json_decode($user->roles)));
            });
    }
}
