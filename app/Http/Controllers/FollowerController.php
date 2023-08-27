<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FollowerController extends Controller
{
    public function __invoke(User $user)
    {
        if($user->id === auth()->user()->id)
        {
            return redirect()->back();
        }

        if($user->followers()->where('follower_id',auth()->user()->id)->exists())
        {
            auth()->user()->following()->detach($user);
            return redirect()->back();
        }

        auth()->user()->following()->attach($user);
        return redirect()->back();
    }
}
