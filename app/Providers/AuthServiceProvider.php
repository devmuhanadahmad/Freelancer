<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Gate;

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
     */
    
    public function register()
    {
        parent::register();
        $this->app->bind('abilities',function(){
            return include base_path('app/data/abilities.php');
        });
    }

    public function boot(): void
    {
        Gate::before(function($user,$ability){
              if($user->type == 'superadmin'){
                return true;
              }
        });

        foreach ($this->app->make('abilities') as $ability => $label)
              {
                  Gate::define($ability, function ($user) use ($ability) {

                      foreach ($user->role as $role)
                      {
                          if (in_array($ability, $role->abilities))
                          {
                              return true;
                          }
                      }
                      return false;
                  });
              }

/*
            Gate::define('user.view',function($user){
             return true;
            });
            Gate::define('user.create',function($user){
                return false;
               });
               Gate::define('user.update',function($user){
                return true;
               });
               Gate::define('user.delete',function($user){
                return false;
               });

*/
    }
}

