<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Post;
use App\User;
use App\Jobask;
use App\Spam;


class DisplayController extends Controller
{
    public function index(Post $Post)
    {
        return view('jobask')->with('post', $Post);
    }

    public function create(Request $request, Post $Post)
    {

        $jobask = new Jobask;

        $request->validate([
            "tel" => "required|regex:/^[0-9]{10,11}$/",
            "email" => "required|email:filter,dns",
            "deadline" => "required|date",
            "comment" => "required|max:500"
        ]);

        //dd($jobask->post_id);
        $jobask->user_id = Auth::id();
        $jobask->posts_id = $Post->id;
        $jobask->tel = $request->tel;
        $jobask->email = $request->email;
        $jobask->deadline = $request->deadline;
        $jobask->comment = $request->comment;
        $jobask->status = 1;
        $Post->tag = 1;


        $jobask->save();
        $Post->save();

        //dd($request);
        return redirect('/home');
    }
}
