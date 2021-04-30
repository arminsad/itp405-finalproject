<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Food;
use App\Models\Ingredient;
use App\Models\Favorite;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
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

        Gate::before(function (User $user){
            if ($user->isAdmin()) {
                return true;
            }
        });

        Gate::define('edit-food', function (User $user, Food $food){
            return $user->id === $food->user_id;
        });

        Gate::define('edit-ingredient', function (User $user, Ingredient $ingredient){
            return $user->id === $ingredient->user_id;
        });

    }
}
