<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Photo $photo)
    {
        if($photo->likers()->where('user_id',auth()->user()->id)->exists())
        {
            $photo->likers()->detach(auth()->user());
            return redirect()->back();
        }

        $photo->likers()->attach(auth()->user());
        return redirect()->back();
    }
}
