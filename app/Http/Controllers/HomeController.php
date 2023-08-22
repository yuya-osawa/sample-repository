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
        $query = Post::orderBy('created_at', 'desc');

        // キーワード検索
        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($query) use ($search) {
                $query->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('comment', 'LIKE', "%{$search}%");
            });
        }

        // 金額範囲検索
        if ($request->has('amount')) {
            $amountOption = $request->input('amount');
            switch ($amountOption) {
                case 1:
                    $query->whereBetween('amount', [1, 999]);
                    break;
                case 2:
                    $query->whereBetween('amount', [1000, 9999]);
                    break;
                case 3:
                    $query->whereBetween('amount', [10000, 49999]);
                    break;
                case 4:
                    $query->whereBetween('amount', [50000, 99999]);
                    break;
                case 5:
                    $query->where('amount', '>=', 100000);
                    break;
            }
        }

        $posts = $query->paginate(7);

        return view('home', ['posts' => $posts]);


        if ($content = $request->input('content')) { // コンテンツの取得
            //dd($request);
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
