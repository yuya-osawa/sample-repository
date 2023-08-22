<!-- user_list.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">ユーザーリスト</div>

                <div class="card-body">
                    @foreach ($users as $user)
                    <div class="card mb-3">
                        <div class="card-body">
                            <div class="d-flex justify-content-center align-items-center mb-3">
                                <div class="mr-3">
                                    <!-- ユーザーアイコン -->
                                    @if ($user->icon)
                                    <img src="{{ asset('storage/'.$user->icon) }}" alt="User Icon" class="rounded-circle" style="width: 80px; height: 80px; object-fit: cover;">
                                    @else
                                    <div class="rounded-circle bg-secondary text-white text-center" style="width: 80px; height: 80px; line-height: 50px;">
                                        No Icon
                                    </div>
                                    @endif
                                </div>
                                <div class="ml-3">
                                    <h5 class="mb-0">ユーザー名：{{ $user->name }}</h5>
                                    <small>メールアドレス：{{ $user->email }}</small>
                                    <p class="mb-0">登録ID: {{ $user->id }}</p>
                                    <p class="mb-0">非表示投稿数: {{ $user->hiddenPostCount }}</p>
                                </div>
                            </div>
                            <div class="text-right">
                                <!-- ユーザー削除ボタンのフォーム -->
                                <form action="{{ route('user.delete', $user->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('本当に削除しますか？')">利用停止</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
<div class="text-center mx-5">
    <a href="#" class="btn btn-info mr-2" onclick='window.history.back(-1);'>🔙</a>
</div>
@endsection