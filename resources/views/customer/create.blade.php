@extends('layout')

@section('content')
    <h1>顧客登録</h1>
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
      <div class="container">
        <form action="{{ route('customer.store') }}" method="post">
            @csrf 
            <div class="row">
                <div class="input-group mb-3 col">
                    <div class="input-group-prepend">
                        <span class="input-group-text" name="basic-addon1">顧客名</span>
                    </div>
                    <input type="text" class="form-control" name="name" placeholder="顧客名">
                </div>   
            </div>
            <div class="row">
                <div class="input-group mb-3 col-12">
                    <div class="input-group-prepend">
                        <span class="input-group-text" name="basic-addon1">カテゴリ</span>
                    </div>
                    <select class="custom-select h-20 my-0" aria-label="Default select example" name="category_id" id="category_id">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="input-group mb-3 col">
                    <div class="input-group-prepend">
                        <span class="input-group-text" name="basic-addon1">ルームID</span>
                    </div>
                    <input type="text" class="form-control" name="cw_id" placeholder="ルームID" required>
                </div>   
            </div>
            <input type="submit" class="btn btn-primary" value="登録">       
        </form>
      </div>
    </div>
@endsection