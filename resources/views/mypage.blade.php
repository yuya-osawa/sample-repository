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

                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
