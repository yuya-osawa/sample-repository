<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        //$posts = Post::all();
        //dd($posts);
        //$posts -> user_id = Auth::id();
        //return view('mypage');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, User $User)
    {
        //dd($request);
        $posts = Post::all();
        //dd($posts);
        $posts->user_id = Auth::id();

        return view('mypage', [
            'posts' => $posts,
            'user' => $User
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $User)
    {
        return view('user_edit')->with('user', $User);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $User)
    {
        $request->validate([
            "name" => "required|max:255",
            "email" => "required|email:filter,dns",
            "image" => "image|mimes:jpeg,png,jpg,gif|max:2048"
        ]);

        $User->name = $request->name;
        $User->email = $request->email;

        if ($request->icon) {

            $image = $request->file('icon')->getClientOriginalName();

            $request->file('icon')->storeAs('', $image, 'public');

            $User->icon = $image;
        }

        $User->save();
        return redirect()->route('User.show', Auth::id());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $User)
    {
        $User->delete();
        return redirect('/login');
    }
}
