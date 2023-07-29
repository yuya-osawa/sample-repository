@extends('layouts.app')

@section('content')
<div class="container">
    <a href= "{{ route('Post.create') }}">
        <button type="submit" class="btn btn-primary">新規投稿</button>
    </a>

    <div class="row justify-content-center">
        <div class="col-md-8">
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
            <div class="text-left d-flex flex-wrap" style="margin-left: 80px; margin-right: 30px;">
    @foreach($posts as $post)
        <table class="p-5 mb-5" style="margin: 10px; background-color: #ffffff;">
            <tr>
                
                <th scope='col' class="p-3">{{ $post['title'] }}</th>
                <th scope='col' class="pr-3">{{ $post['date'] }}</th>
            </tr>
            <!--<tr>
                <th scope='col' class="pl-3">{{ $post['post'] }}</th>
            </tr>-->
            <tr>
                <th scope='col' class="pl-3 pb-3">
                    @if(empty($post['image']))
                    画像の投稿はありません
                    @elseif(!empty($post['image']))
                    <img src="{{ asset('storage/'.$post['image']) }}" style="width: 230px; height: 230px; object-fit: cover;">
                    @endif
                </th>
            </tr>
        </div>
    </div>
</div>
@endsection
