@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center">
                @if(empty(Auth::user()->icon))
                <div class="rounded-circle bg-secondary text-white text-center" style="width: 200px; height: 200px; line-height: 200px; font-size: 32px;">
                    NO ICON
                </div>
                @elseif(!empty(Auth::user()->icon))
                <img src="{{ asset('storage/'.Auth::user()->icon) }}" style="width: 200px; height: 200px; object-fit: cover; border-radius: 50%;">
            </div>
            @endif
            <div class="text-center my-3 font-weight-bold">
                {{ Auth::user()->name }}
                <a href="{{ route('User.edit', Auth::id()) }}">編集</a>
                @csrf
                <a href="{{ route('Post.create') }}">新規投稿</a>
                @csrf
            </div>
            <div class="text-center font-weight-bold">
                {{ Auth::user()->email }}
            </div>

            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    my page!
                </div>
            </div>

            <a href="{{ route('joboffer.show') }}">

                <button class="btn btn-primary text-nowrap">依頼を受けた投稿</button>
            </a>


            <div class="row mt-4">
                @foreach($posts as $post)
                @if(Auth::id() == $post['user_id'])
                <div class="col-md-4 mb-4">
                    <div class="p-3" style="background-color: #ffffff;">
                        <a href="{{ route('Post.show',$post['id']) }}">
                            @csrf
                            <h5>{{ $post['title'] }}</h5>
                        </a>
                        {{ $post['date'] }}
                        <div class="mt-3">
                            @if(empty($post['image']))
                            画像の投稿はありません
                            @elseif(!empty($post['image']))
                            <img src="{{ asset('storage/'.$post['image']) }}" style="width: 100%; height: auto; object-fit: cover;">
                            @endif
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>
    </div>
</div>
@endsection