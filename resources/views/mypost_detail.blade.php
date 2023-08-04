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

    <div class="text-center">
        <form action="{{ route('Post.update', Auth::user()->id) }}" method="POST" enctype="multipart/form-data">
            @method('patch')
            @csrf
            <div class="mb-3">
                <lavel for="formGroupExampleInput" class="form-lavel">タイトル</lavel>
                <input type="text" name="title" placeholder="タイトル" value="{{ old('title', $post['title']) }}">
            </div>

            <div class="mb-3">
                <lavel for="formGroupExampleInput" class="form-lavel">金額</lavel>
                <input type="text" name="amount" placeholder="金額" value="{{ old('amount', $post['amount']) }}">
            </div>

            <div class="mb-3">
                <lavel for="formGroupExampleInput2" class="form-lavel">投稿日</lavel>
                <input type="date" name="date" placeholder="0000/00/00" value="{{ old('date', $post['date']) }}">
            </div>

            <div class="mb-3">
                <lavel for="formGroupExampleInput3" class="form-lavel">投稿内容</lavel>
                <textarea name="post">{{ old('comment', $post['comment']) }}</textarea><br>
            </div>

            <div class="mb-3">
                <lavel for="formGroupExampleInput4" class="form-lavel">投稿画像</lavel>
                <input type="file" id="image" name="image">
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">編集</button>
                <a href= "{{ route('Post.destroy',Auth::user()->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="submit" value="削除" class="btn btn-danger" onclick='return confirm("この投稿を削除しますか？");'>
                </a>
                <a href="#" class="btn btn-secondary"onclick='window.history.back(-1);'>戻る</a>
                <a href="/home" class="btn btn-secondary">ホームへ</a>
            </div>
        </form>
    </div>
</div>
              
@endsection
