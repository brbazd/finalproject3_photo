<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ProfilePictureController extends Controller
{
    /**
     * Updates the user's profile picture.
     */
    public function update(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg,gif|max:4096'
        ]);

        if(auth()->user()->picture_url !== null)
        {
            $img_to_delete = auth()->user()->picture_url;

            File::delete(public_path('/storage/profiles/images/'.$img_to_delete));

            auth()->user()->update(['picture_url' => null]);
        }


        $path = storage_path('app/public/profiles/images/');
        $img_name = md5(time()) . '.' . $request->image->extension();

        if (!file_exists($path)) {
            mkdir($path, 777, true);
        }

        $img = Image::make($request->file('image'));

        $width = 480;
        $height = 480;

        $img->height() > $img->width() ? $height=null : $width=null;

        $img->resize($width, $height, function($constraint){
            $constraint->aspectRatio();
        });


        $img->crop(480,480);

        $img->save($path.$img_name, 75, 'jpg');

        $request->user()->picture_url = $img_name;

        $request->user()->save();


        return redirect(route('profile.edit'))->with('status', 'profile-picture-updated');


    }

    /**
     * Deletes the user's profile picture.
     */
    public function destroy(Request $request)
    {
        if(auth()->user()->picture_url === null) return redirect(route('profile.edit'));

        $img_to_delete = auth()->user()->picture_url;

        File::delete(public_path('/storage/profiles/images/'.$img_to_delete));

        auth()->user()->update(['picture_url' => null]);

        return redirect(route('profile.edit'))->with('status', 'profile-picture-deleted');
    }
}
