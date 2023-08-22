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

            <div class="card">
                <div class="card-header">Dashboard</div>
                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif
                    Job Offer List!
                </div>
            </div>


            <div class="card mt-4">
                <div class="card-header">投稿と依頼一覧</div>
                <div class="card-body d-flex flex-wrap">
                    @foreach($posts as $post)
                    <div class="p-3 mb-4" style="background-color: #ffffff; flex: 0 0 50%;">
                        タイトル：{{ $post->title }}<br>
                        投稿日：{{ $post->date }}<br>
                        金額：{{ $post->amount }}
                        <div class="mt-3">
                            @if(empty($post->image))
                            画像の投稿はありません
                            @elseif(!empty($post->image))
                            <img src="{{ asset('storage/'.$post->image) }}" style="width: 100%; height: auto; object-fit: cover;">
                            @endif
                        </div>
                    </div>
                    @endforeach

                    @foreach($jobasks as $jobask)
                    <div class="p-3 mb-4" style="background-color: #ffffff; flex: 0 0 50%;">
                        依頼者：{{ $jobask->user->name }}<br>
                        依頼日：{{ $jobask->created_at}}<br>
                        電話番号：{{ $jobask->tel }}<br>
                        メールアドレス：{{ $jobask->email }}<br>
                        納期(期限):{{ $jobask->deadline }}<br>
                        コメント：{{ $jobask->comment }}
                    </div>
                    @if($post->tag == 1)
                    <form action="{{ route('joboffer.update2',$post['id']) }}" method="GET">
                        @csrf
                        <input type="hidden" value="{{$post['id']}}" name="post_id">
                        <input type="submit" value="依頼完了" class="btn btn-danger" onclick='return confirm("作業完了させますか？");'>
                    </form>
                    @elseif($post->tag == 2)
                    この依頼は完了しています
                    @endif
                    @endforeach
                </div>
            </div>

        </div>
    </div>
    <div class="text-center">
        <a href="#" class="btn btn-info mr-2" onclick='window.history.back(-1);'>🔙</a>
    </div>
</div>
</div>
</div>
</div>
@endsection