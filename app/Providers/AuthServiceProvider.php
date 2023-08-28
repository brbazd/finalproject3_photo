<?php

namespace App\Providers;

use App\Models\User;
use App\Models\Photo;
use App\Models\Comment;
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
    public function boot(): void
    {
        Gate::define('show-private-photo', function (User $user, Photo $photo) {
            if ($photo->is_private === 1)
            {
                if($user->role->name === 'admin')
                {
                    return true;
                }
                return $user->id === $photo->user_id;
            }
            else return true;
        });

        Gate::define('check-if-user-is-owner', function (User $user, Photo $photo) {
            return $user->id === $photo->user_id;
        });

        Gate::define('check-if-user-is-commenter', function (User $user, Comment $comment) {
            return $user->id === $comment->user_id;
        });

        Gate::define('check-if-user-is-admin', function (User $user) {
            return $user->role->name === 'admin';
        });

    }
}
