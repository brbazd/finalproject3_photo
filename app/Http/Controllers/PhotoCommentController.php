<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PhotoCommentController extends Controller
{

    public function show(Photo $photo)
    {
        if (!Gate::allows('show-private-photo', $photo))
        {
            return redirect(route('dashboard'))->with('status', "You are not authorized to view the comments of this post." );
        }

        $comments = Comment::where('photo_id',$photo->id)->with('user')->latest('created_at')->paginate(15);

        return view('photo.comments',compact('comments','photo'));

    }

    public function store(Request $request, Photo $photo)
    {
        $request->validate([
            'body' => 'required|string|max:4000'
        ]);

        Comment::create([
            'photo_id' => $photo->id,
            'user_id' => auth()->user()->id,
            'body' => $request->body
        ]);

        return redirect()->back();
    }

    public function destroy(Photo $photo, Comment $comment)
    {
        if (Gate::denies('check-if-user-is-commenter', $comment) && Gate::denies('check-if-user-is-admin') && Gate::denies('check-if-user-is-owner', $photo))
        {
            return redirect()->back()->with('status', "You are not authorized to delete this comment." );
        }

        $comment->delete();

        return redirect()->back();
    }

    public function edit(Photo $photo, Comment $comment)
    {
        return view('photo.comment-edit',compact('comment','photo'));
    }

    public function update(Request $request, Photo $photo, Comment $comment)
    {
        $request->validate([
            'body' => 'required|string|max:4000'
        ]);

        $comment->update(['body' => $request->body]);

        return redirect(route('photos.show',$photo->id));
    }
}
