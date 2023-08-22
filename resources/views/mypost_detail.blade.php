@extends('layouts.app')

@section('content')

<div class="container">
    @if ($errors->any())
    <ul>
        @foreach ($errors->all() as $error)
        <li class="text-danger list-unstyled">{{ $error }}</li>
        @endforeach
    </ul>
    @endif
</div>

<div class="card mx-auto mt-4" style="max-width: 600px;">
    <div class="card-header text-center">投稿内容</div>
    <div class="card-body">
        @if(Auth::id() == $post['user_id'])
        <form action="{{ route('Post.update', $post['id']) }}" method="POST" enctype="multipart/form-data">
            @method('patch')
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">タイトル</label>
                <input type="text" name="title" class="form-control" placeholder="タイトル" value="{{ old('title', $post['title']) }}">
            </div>

            <div class="mb-3">
                <label for="amount" class="form-label">金額</label>
                <input type="text" name="amount" class="form-control" placeholder="金額" value="{{ old('amount', $post['amount']) }}">
            </div>

            <div class="mb-3">
                <label for="date" class="form-label">投稿日</label>
                <input type="date" name="date" class="form-control" placeholder="0000/00/00" value="{{ old('date', $post['date']) }}">
            </div>

            <div class="mb-3">
                <label for="comment" class="form-label">投稿内容</label>
                <textarea name="comment" class="form-control">{{ old('comment', $post['comment']) }}</textarea>
            </div>

            <div class="mb-3">
                <label for="image" class="form-label">投稿画像</label>
                <input type="file" id="image" name="image" class="form-control-file">
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary mr-2">編集</button>
                <input type="submit" value="削除" class="btn btn-danger" onclick='return confirm("この投稿を削除しますか？");'>
                <a href="#" class="btn btn-info mr-2" onclick='window.history.back(-1);'>🔙</a>
            </div>
        </form>
        @endif
    </div>


    <!-- 他ユーザーの詳細画面 -->

    @if(Auth::id() != $post['user_id'])

    <div class="card-body">
        <div class="mb-3">
            <label for="status" class="form-label">ステータス:</label>
            @if($post->tag == 0)
            掲載中
            @else
            進行中
            @endif
        </div>

        <!-- タイトル表示 -->
        <div class="mb-3">
            <label for="title" class="form-label">タイトル</label>
            <div>{{ $post['title'] }}</div>
        </div>

        <!-- 金額表示 -->
        <div class="mb-3">
            <label for="amount" class="form-label">金額</label>
            <div>{{ $post['amount'] }}</div>
        </div>

        <!-- 投稿日表示 -->
        <div class="mb-3">
            <label for="date" class="form-label">投稿日</label>
            <div>{{ $post['date'] }}</div>
        </div>

        <!-- 投稿内容表示 -->
        <div class="mb-3">
            <label for="comment" class="form-label">投稿内容</label>
            <div>{{ $post['comment'] }}</div>
        </div>

        <!-- 画像表示 -->
        <div class="mb-3">
            <label for="image" class="form-label">投稿画像</label>
            <div>
                @if(empty($post['image']))
                画像の投稿はありません
                @elseif(!empty($post['image']))
                <img src="{{ asset('storage/'.$post['image']) }}" style="width: 100px; height: 100px; object-fit: cover;">
                @endif

                <div class="text-center">
                    <a href="{{ route('jobask.index',$post->id) }}" class="btn btn-primary">依頼</a>
                    <form action="{{ route('Spam.show',$post->id) }}" method="get" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-primary">違反報告ページへ</button>
                    </form>
                    <a href="#" class="btn btn-info mr-2" onclick='window.history.back(-1);'>🔙</a>

                </div>
                @endif
            </div>
        </div>
    </div>
</div>


@endsection