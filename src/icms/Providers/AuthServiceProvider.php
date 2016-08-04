<?php 

namespace ICMS\Providers;

use Illuminate\Contracts\Auth\Access\Gate as GateContract;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use ICMS\Auth\AuthManager;

class AuthServiceProvider extends ServiceProvider {
	/**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any application authentication / authorization services.
     *
     * @param  \Illuminate\Contracts\Auth\Access\Gate  $gate
     * @return void
     */
    public function boot(GateContract $gate)
    {
        $this->registerPolicies($gate);

        $this->app->singleton('icms.auth', function ($app) use ($gate) {
            return new AuthManager($gate, $app);
        });

        $instance = $this->app->make('icms.auth');
    }
}