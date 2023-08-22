<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use App\Jobask;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class JobOfferController extends Controller
{
    public function show(Request $request, User $user, Jobask $Jobask)
    {

        // ログインユーザーのIDを取得
        $userId = Auth::id();

        // ログインユーザーが投稿したかつstatusカラムが1の投稿を取得
        $posts = Post::where('user_id', $userId)
            ->where('tag', 1)
            ->orwhere('tag', 2)
            ->get();
        //dd($posts);

        // 投稿に紐づくjobaskデータを取得
        $jobasks = Jobask::whereIn('posts_id', $posts->pluck('id'))->get();
        //dd($jobask);

        return view('joboffer', [
            'user' => $user,
            'posts' => $posts,
            'jobasks' => $jobasks
        ]);
    }
}
