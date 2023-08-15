@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @foreach($spamReports as $spamReport)
            <div class="card mb-3">
                <div class="row no-gutters">
                    <div class="col-md-2">
                        <!-- ユーザーアイコン表示のロジック -->
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title">{{ $spamReport['post']['name'] }}</h5>
                            <!-- ユーザー名表示のロジック -->
                            <p class="card-text">{{ $spamReport['post']['title'] }}</p>
                            <p class="card-text">{{ $spamReport['post']['amount'] }}</p>
                            <p class="card-text">{{ $spamReport['post']['date'] }}</p>
                            <p class="card-text">{{ $spamReport['post']['comment'] }}</p>
                            <div class="card-text">
                                @foreach($spamReport['reports'] as $report)
                                <span class="badge badge-warning">{{ $report }}</span>
                                @endforeach
                            </div>
                            <div class="card-text">
                                違反報告件数: {{ $spamReport['report_count'] }}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-2">
                        <a href="{{ route('post.deleteflg', $spamReport['post']['id']) }}" onclick='return confirm("本当に表示停止しますか？");'>
                            <button class="btn btn-danger btn-sm">表示停止</button>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
<div class="text-right mx-5">
    <a href="#" class="btn btn-secondary" onclick='window.history.back(-1);'>戻る</a>
</div>
@endsection