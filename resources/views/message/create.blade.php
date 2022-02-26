@extends('layout')

@section('content')
    <h1>メッセージ登録</h1>
    <hr>
    <!-- 商品登録時のフラッシュメッセージ -->
    @if (session('flash_message'))
        <div class="alert alert-success" role="alert">
            {{ session('flash_message') }}
        </div>
    @endif
    <!-- バリエーションエラー時のメッセージ -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <form action="{{route('message.store')}}" method="post">
    @csrf
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">タイトル</span>
            </div>
            <input type="text" class="form-control" name="title" aria-label="messagetitle" aria-describedby="basic-addon1">
        </div>

        <div class="input-group" style="height: 250px;">
            <div class="input-group-prepend">
                <span class="input-group-text" style="padding: 20px;">定型文</span>
            </div>
            <textarea class="form-control" name="message" aria-label="message"></textarea>
        </div>

        <div class="mx-auto" style="width: 200px;">
            <input type="submit" class="mb-2 btn btn-primary w-50 h-50 my-5" value="登録">
        </div>
    </form>
@endsection
