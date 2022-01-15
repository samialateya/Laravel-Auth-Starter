<?php

namespace App\Providers;

use App\Models\User;
use App\Policies\Admin\AdminsPolicy;
use Illuminate\Support\Facades\Gate;
use App\Policies\Admin\AdminNewPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
			User::class => AdminsPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate::define('view-admins', [AdminsPolicy::class, 'view']);
    }
}
