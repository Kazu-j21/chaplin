@extends('layout')

@section('content')
    <h1>メッセージ編集</h1>
    <hr>
    <!-- メッセージ編集時のフラッシュメッセージ -->
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

    <form action="{{route('message.update', $message->id)}}" method="post">
    @csrf
        @method('patch')
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">タイトル</span>
            </div>
            <input type="text" class="form-control" name="title" value="{{($message->title)}}" aria-label="messagetitle" aria-describedby="basic-addon1">
        </div>

        <div class="input-group" style="height: 250px;">
            <div class="input-group-prepend">
                <span class="input-group-text" style="padding: 20px;">定型文</span>
            </div>
            <textarea class="form-control" name="message" aria-label="message">{{($message->name)}}</textarea>
        </div>

        <div class="container" style="width: 200px;">
            <input type="submit" class="mb-2 btn btn-primary w-75 h-50 my-5" value="編集">
        </div>
    </form>

    <form action="{{route('message.destroy', $message->id)}}" method="post">
    @csrf
        @method('delete')
        <div class="container" style="width: 200px;">
            <input type="submit" value="削除" class="mb-2 btn btn-danger w-75 h-50 my-0" onclick='return confirm("削除しますか？");'>
        </div>
    </form>
@endsection