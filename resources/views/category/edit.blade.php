@extends('layout')

@section('content')
    <h1>カテゴリ編集</h1>
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
    <div class="text-center">
        <form action="{{ route('category.update', $category->id) }}" method="post">
            @method('PATCH')
            @csrf 
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" name="basic-addon1">カテゴリ</span>
                </div>
                <input type="text" class="form-control" name="name" value="{{ $category->name }}">
            </div>
            <div class="container" style="width: 200px;">
                <input type="submit" class="mb-2 btn btn-primary w-75 h-50 my-5" value="編集">
            </div>        
        </form>

        <form action="{{ route('category.update', $category->id) }}" method="post">
            @csrf
            @method('delete')
            <div class="container" style="width: 200px;">
                <input type="submit" value="削除" class="mb-2 btn btn-danger w-75 h-50 my-0" onclick='return confirm("削除しますか？");'>
            </div>
        </form>
    </div>
@endsection