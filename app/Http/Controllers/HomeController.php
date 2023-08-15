<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;
use App\Post;
use App\User;
use App\Jobask;
use App\Spam;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request, Post $Post)
    {
        // dd($Post::orderBy('created_at', 'desc')->offset(0)->limit(7)->get());
        $posts = Post::orderBy('created_at', 'desc')->paginate(7);

        if ($request->search) {
            $posts = Post::orderBy('created_at', 'asc')->where(function ($query) {

                // 検索機能
                $search = request('search');
                $query->where('title', 'LIKE', "%{$search}%")->orWhere('amount', 'LIKE', "%{$search}%")->orWhere('comment', 'LIKE', "%{$search}%");
            })->get();
        }

        if ($content = $request->input('content')) { // コンテンツの取得
            dd($request);
            return response()->json(['content' => $content]);
        }
        $count = $posts->count();


        return view('home', [
            'posts' => $posts,
            'count' => $count
        ]);
    }
    public function ajaxscroll($page)
    {
        $start = $page * 7 - 5;

        $posts = Post::orderBy('created_at', 'desc')->offset($start)->limit(7)->get();

        return response()->json($posts);
    }
}
