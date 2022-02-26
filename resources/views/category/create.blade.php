@extends('layout')

@section('content')
    <h1>カテゴリ登録</h1>
    <hr>
    <!-- 商品登録時のフラッシュメッセージ -->
    <!-- @if (session('flash_message'))
        <div class="alert alert-success" role="alert">
            {{ session('flash_message') }}
        </div>
    @endif -->
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
        <form action="{{ route('category.store') }}" method="post">
            @csrf 
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" name="basic-addon1">カテゴリ</span>
                </div>
                <input type="text" class="form-control" name="name" placeholder="カテゴリ" required>
            </div>   
        <input type="submit" class="btn btn-primary" value="登録">       
        </form>
    </div> 
@endsection