@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <form class="form-inline my-2 my-lg-0 ml-2">
                <div class="form-group">
                    <input type="search" class="form-control mr-sm-2" name="search" value="{{request('search')}}" placeholder="キーワードを入力" aria-label="検索...">
                </div>
                <input type="submit" value="検索" class="btn btn-info">
            </form>
            <div class="card" id="append">
                <div class="card-header">Dashboard</div>


                @if(Auth::user()->role == 0)

                @foreach($posts as $post)
                @if(Auth::check())
                @if(Auth::id() != $post['user_id'])
                <table class="p-5 mb-5" style="margin: 10px; background-color: #ffffff;">
                    <tr>

                        <th scope='col' class="pr-3">
                            @if($post->del_flg == 1)
                            <h5 class="card-title">非表示済み</h5>
                            <p class="card-text">この投稿は非表示にされています。</p>
                            @else
                            <a href="{{ route('Post.show',$post['id']) }}">
                                @csrf
                                {{ $post['title'] }}
                            </a>
                            {{ $post['date'] }}
                        </th>
                    </tr>

                    <tr>
                        <th scope='col' class="pl-3 pb-3">
                            @if(empty($post['image']))
                            画像の投稿はありません
                            @elseif(!empty($post['image']))
                            <img src="{{ asset('storage/'.$post['image']) }}" style="width: 230px; height: 230px; object-fit: cover;">
                            @endif
                        </th>
                    </tr>
                </table>
                @endif

                <!-- 無限スクロール　-->
                <input type="hidden" id="count" value="1">
                <div id="append">
                </div>
                @endif




                @else
                <table class="p-5 mb-5" style="margin: 10px; background-color: #ffffff;">
                    <tr>


                        <th scope='col' class="pr-3">
                            <a href="{{ route('Post.show',$post['id']) }}">
                                @csrf
                                {{ $post['title'] }}
                            </a>
                            {{ $post['date'] }}
                        </th>
                    </tr>

                    <tr>
                        <th scope='col' class="pl-3 pb-3">
                            @if(empty($post['image']))
                            画像の投稿はありません
                            @elseif(!empty($post['image']))
                            <img src="{{ asset('storage/'.$post['image']) }}" style="width: 230px; height: 230px; object-fit: cover;">
                            @endif
                        </th>
                    </tr>
                    @endif



                    @endforeach
                    @else
                    <div class="text-center">
                        <div class="m-5">
                            <a href="{{ route('postlist.show') }}">投稿リスト表示</a>
                            @csrf
                        </div>
                        <div class="m-5">
                            <form action="{{ route('userlist.show') }}" method="get">
                                @csrf
                                <button type="submit" class="btn btn-primary text-nowrap">ユーザーリスト表示</button>
                            </form>
                        </div>


                        @endif

                    </div>
            </div>
        </div>
    </div>
    @endsection