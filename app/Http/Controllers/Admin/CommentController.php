<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDO;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $comments = Comment::query();

        if($keyword = request('search')) {
            $comments->where('comment' , 'LIKE' , "%{$keyword}%")->orWhereHas('user' , function($query) use ($keyword){
                $query->where('name' , 'LIKE' , "%{$keyword}%");
            });
        }
        $comments = $comments->whereApproved(1)->latest()->paginate(20);
        return view('admin.comments.all' , compact('comments'));
    }

     public function unapproved()
    {
        $comments = Comment::query();

        if($keyword = request('search')) {
            $comments->where('comment' , 'LIKE' , "%{$keyword}%")->orWhereHas('user' , function($query) use ($keyword){
                $query->where('name' , 'LIKE' , "%{$keyword}%");
            });
        }

        $comments = $comments->whereApproved(0)->latest()->paginate(20);
        return view('admin.comments.unapproved' , compact('comments'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {   
        $comment->update(['approved' => 1]);
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Comment $comment)
    {
        $comment->delete();
        return back();
    }
}
