<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Photo;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Gate;
use Intervention\Image\Facades\Image;

class PhotoController extends Controller
{
    /**
     * Display a listing of all the photos recently posted.
     */
    public function index()
    {
        $photos = Photo::latest('created_at')->public()->paginate(12);

        return view('photo.index',compact('photos'));
    }

    /**
     * Show the form for creating a new photo.
     */
    public function create()
    {
        return view('photo.create');
    }

    /**
     * Store a newly created photo in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:4000',
            'image' => 'required|image|mimes:png,jpg,jpeg,gif|max:4096'
        ]);

        $path = storage_path('app/public/images/');
        $img_name = md5(time()) . '.' . $request->image->extension();

        if (!file_exists($path)) {
            mkdir($path, 777, true);
        }

        $img = Image::make($request->file('image'));

        $img->resize(null, 1440, function($constraint){
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $img->save($path.$img_name, 75, 'jpg');

        $is_private = false;

        $request->is_private == "1" ? $is_private = true : $is_private = false;


        Photo::create([
            'user_id' => auth()->user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'url' => $img_name,
            'is_private' => $is_private
        ]);

        return redirect(route('dashboard'))->with('status', 'Photo successfully uploaded!');

    }

    /**
     * Display the photo.
     */
    public function show(Photo $photo)
    {
        if (!Gate::allows('show-private-photo', $photo))
        {
            return redirect(route('dashboard'))->with('status', "You are not authorized to view this post." );
        }

        $comments = Comment::where('photo_id',$photo->id)->with('user')->latest('created_at')->take(10)->get();

        $comment_count = count(Comment::where('photo_id',$photo->id)->get());

        $more_photos = Photo::where('user_id',$photo->user_id)->public()->whereNotIn('id',array($photo->id))->latest('created_at')->take(4)->get();

        return view('photo.show',compact('photo','more_photos','comments','comment_count'));
    }

    /**
     * Show the form for editing the photo.
     */
    public function edit(Photo $photo)
    {
        if (!Gate::allows('check-if-user-is-owner', $photo))
        {
            return redirect(route('dashboard'))->with('status', "You're not allowed to edit this photo." );
        }

        return view('photo.edit', compact('photo'));
    }

    /**
     * Update the specific photo in storage.
     */
    public function update(Request $request, Photo $photo)
    {
        if (!Gate::allows('check-if-user-is-owner', $photo))
        {
            return redirect(route('dashboard'))->with('status', "You're not allowed to edit this photo." );
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string|max:4000',
        ]);

        $is_private = false;

        $request->is_private == "1" ? $is_private = true : $is_private = false;

        $photo->update([
            'title' => $request->title,
            'description' => $request->description,
            'is_private' => $is_private
        ]);

        return redirect(route('photos.show',$photo->id));

    }

    /**
     * Remove the specified photo from storage.
     */
    public function destroy(Photo $photo)
    {
        if (Gate::denies('check-if-user-is-owner', $photo) && Gate::denies('check-if-user-is-admin'))
        {
            return redirect(route('dashboard'))->with('status', "You're not allowed to delete this photo." );
        }

        File::delete(public_path('/storage/images/'.$photo->url));
        $photo->delete();

        return redirect(route('users.show',auth()->user()->id));
    }
    /**
     * Display all the users who have liked the photo.
     */

    public function view_likers(Photo $photo)
    {
        if (!Gate::allows('show-private-photo', $photo))
        {
            return redirect(route('dashboard'))->with('status', "You are not authorized to view this post." );
        }

        $likers = $photo->likers()->paginate(15);

        // dd($likers);

        return view('photo.likers',compact('photo','likers'));
    }

    /**
     * Display all the photos from the users the logged-in user is following.
     */

    public function feed()
    {
        $user = User::find(auth()->user()->id);

        $people_user_follows = $user->following()->get();

        $follows_ids = $people_user_follows->pluck('id')->toArray();

        $photos = Photo::whereIn('user_id',$follows_ids)->public()->paginate(12);

        return view('photo.feed',compact('photos'));

    }

}
