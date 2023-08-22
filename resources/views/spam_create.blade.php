@extends('layouts.app')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8 text-center p-5">
        <form action="{{ route('spam.report',$post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            違反報告理由<br>
            <textarea name="report" class='form-control'></textarea><br>

            <button type="submit" class="btn btn-danger" class="m-3">報告する</button>
            <a href="#" class="btn btn-info mr-2" onclick='window.history.back(-1);'>🔙</a>
        </form>
    </div>
</div>
@endsection