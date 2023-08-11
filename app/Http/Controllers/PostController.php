<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Jobask;
use App\Spam;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(){

        return view('create_newpost');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post;
        
        $post -> user_id = Auth::id();
        $post->title = $request->title;
        $post->amount = $request->amount;
        $post->comment = $request->comment;
        $post->date = $request->date;
        $post->image = $request->image;

        //Auth::user()->post()->save($post);
        $post -> save();

        return redirect()->route('User.show',Auth::id());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $Post)
    {
       
        return view('mypost_detail')->with('post', $Post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $Post)
    {
        return view('mypost_detail')->with('post', $Post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $Post)
    {
        $Post->user_id = Auth::id();
        $Post->title = $request->title;
        $Post->amount = $request->amount;
        $Post->comment = $request->comment;
        $Post->date = $request->date;
        $Post->image = $request->image;

        $Post->save();

        return redirect()->route('User.show',Auth::id());
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $Post)
    {
         
        
        $Post->delete();
        
        return redirect()->route('User.show',Auth::id())->with('投稿を削除しました');
       
    }
}
