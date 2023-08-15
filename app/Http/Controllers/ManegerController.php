<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\support\Facades\Auth;
use App\Post;
use App\User;
use App\Jobask;
use App\Spam;


class ManegerController extends Controller
{
    // ManegerController.php

    // ManegerController.php

    public function show(Post $Post, Spam $Spam)
    {
        $spamReports = []; // 違反報告をまとめて格納する配列

        $Spam = Spam::all();
        $Post = Post::all();

        foreach ($Post as $value) {
            $reports = []; // この投稿に対する違反報告を格納する配列

            foreach ($Spam as $val) {
                if ($value['id'] == $val['posts_id']) {
                    $reports[] = $val['report'];
                }
            }

            if (!empty($reports)) {
                $spamReports[] = [
                    'post' => $value,
                    'reports' => $reports,
                    'report_count' => count($reports), // 違反報告の件数を追加
                ];
            }
        }

        return view('post_list', [
            'spamReports' => $spamReports,
        ]);
    }



    public function PostDeleteflg(Post $post)
    {
        // 違反報告を取得
        $spamReports = Spam::where('posts_id', $post->id)->get();

        // 違反報告がある場合は論理削除フラグを設定
        if ($spamReports->count() > 0) {
            $post->update(['del_flg' => 1]);
        }

        return redirect()->route('postlist.show');
    }


    public function showUsers()
    {
        $users = User::where('role', '!=', 1)->get(); // roleが1でないユーザーを取得

        // 非表示になっている投稿の件数を取得してユーザー情報に追加
        foreach ($users as $user) {
            $hiddenPostCount = Post::where('user_id', $user->id)->where('del_flg', 1)->count();
            $user->hiddenPostCount = $hiddenPostCount;
        }

        return view('user_list', [
            'users' => $users,
        ]);
    }


    public function deleteUser(Request $request, $userId)
    {
        // ユーザーを物理削除
        User::findOrFail($userId)->delete();

        return redirect()->back()->with('success', 'ユーザーが削除されました。');
    }
}
