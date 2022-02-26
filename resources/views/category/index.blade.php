@extends('layout')

@section('content')
    <h1>カテゴリ一覧</h1>
    <hr>
    <!-- 商品登録時のフラッシュメッセージ -->
    @if (session('flash_message'))
        <div class="alert alert-success" role="alert">
            {{ session('flash_message') }}
        </div>
    @endif

    <div class="container-fluid">  
        <div class="row">    
            <!--↓↓ 検索フォーム ↓↓-->
            <div class="col-10">
                <form class="form-inline" action="{{url('/category')}}">
                    <div class="form-group">
                        <input type="text" name="keyword" value="{{ $keyword }}" class="form-control" placeholder="名前を入力してください">
                    </div>
                    <input type="submit" value="検索" class="btn btn-info ml-2">
                </form>
            </div>
            <!--↑↑ 検索フォーム ↑↑-->

            <div class="col-2 text-right">
                <a href="{{ route('category.create') }}">
                    <button class="m-2 btn btn-primary">登録</button>
                </a>
            </div>
        </div>    
    </div>
    <div class="col">
        <table class="product datatable table table-bordered table-sorted text-center">
            <thead class="table">
                <tr>
                    <td>@sortablelink('name', 'カテゴリ')</td>
                    <td>操作</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
            　　    <tr>
                        <td>{{ $category->name }}</td>
                        <td><a class="btn btn-sm btn-primary" href="{{ route('category.edit', $category->id) }}">編集</a></td>
                   </tr>       
                 @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center paginate mt-5">
            {{ $categories->links() }}
        </div>
    </div>
@endsection