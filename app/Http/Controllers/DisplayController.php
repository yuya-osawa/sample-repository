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

    public function create(Request $request ,Post $Post)
    {
        
        $jobask = new Jobask;
        //dd($jobask->post_id);
        $jobask -> user_id = Auth::id();
        $jobask->posts_id = $Post->id;
        $jobask->tel = $request->tel;
        $jobask->email = $request->email;
        $jobask->deadline = $request->deadline;
        $jobask->comment = $request->comment;
        
        $jobask -> save();
    
        //dd($request);
        return redirect('/home');
        
    }
}
