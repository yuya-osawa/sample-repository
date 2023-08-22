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

                    <form action="{{ route ('jobask.create',$post->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf


                        <label for='title'>電話番号</label>
                        <input type='text' class='form-conrol' name='tel' value="{{ old('tel') }}" />
                        <br>
                        <label for='amount'>メールアドレス</label>
                        <input type='text' class='form-conrol' name='email' value="{{ old('email') }}" />
                        <br>
                        <label for='comment' class='mt-2'>希望納期</label>
                        <input type='date' name='deadline' id='deadline' class='col-sm-8' placeholder='0000/00/00'>
                        <br>
                        <label for='date'>コメント</label>
                        <textarea class='form-control' name='comment'></textarea>




                        <div class="text-center">
                            <button type='submit' class='btn-primary w-25 mt-3'>依頼する</button>
                            <a href="#" class="btn btn-info mr-2" onclick='window.history.back(-1);'>🔙</a>
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