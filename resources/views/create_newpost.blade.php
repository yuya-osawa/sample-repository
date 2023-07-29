@extends('layouts.app')

@section('content')
<main class="py=4">
    <div class="col-md-5 mx-auto">
        <div class="card">
            <div class="card-header">
                <h4 class='text-center'>新規投稿</h1>
            </div>

            <div class="card-body">
                <div class="card-body">

                    <div class='panel-body'>
                        @if($errors->all())
                        <div class='alert-danger'>
                            <ul>
                                @foreach(@$errors->all() as $message)
                                <li>{{ $message }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>

                    <form action="{{ route ('Post.create') }}" method="post">
                        @csrf
                        <label for='title'>タイトル</label>
                            <input type='text' class='form-conrol' name='title' value="{{ old('title') }}"/>
                            <br>
                        <label for='amount'>金額</label>
                            <input type='text' class='form-conrol' name='amount' value="{{ old('amount') }}"/>
                            <br>
                        <label for='comment' class='mt-2'>内容</label>
                            <textarea class='form-control' name='comment'></textarea>
                            <br>
                            <label for='image'>画像</label>
                            <input type='text' class='form-conrol' name='image' value="{{ old('image') }}"/>
                            <div class='row justify-content-center'>
                            <button type='submit' class="btn btn-outline-primary">ファイルを選択</button>
                        </div>
                           
                        <div class='row justify-content-center'>
                            <button type='submit' class='btn-primary w-25 mt-3'>投稿</button>
                        </div>
                    </form>

                    </div>
                </div>
            </div>
                


                    
<!--
<div class="container">
    
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
-->
@endsection
