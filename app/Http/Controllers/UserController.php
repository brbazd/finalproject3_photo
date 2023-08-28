<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Displays the user and all his public photos.
     */
    public function show(User $user)
    {
        if ($user->id === auth()->user()->id || auth()->user()->role->name === 'admin')
        {
            $user->with('photos')->get();
            $photos = $user->photos()->paginate(12);
        }
        else
        {
            $user->with('photos')->get();
            $photos = $user->photos()->public()->paginate(12);
        }
        return view('user.show',compact('user','photos'));
    }
}
