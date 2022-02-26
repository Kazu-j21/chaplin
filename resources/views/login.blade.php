@extends('layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-3"></div>
        <div class="col-md-6">
            <br>
            <h1>ログイン</h1><br>
            @if(count($errors) >0)
                <div class="alert alert-danger">
                    @foreach($errors->all() as $error)
                    <p>{{ $error }}</p>
                    @endforeach
                </div>
            @endif
            {{-- ログイン失敗時に出力 --}}
            @if (session('flash_message'))
                <div class="alert alert-danger">
                    {{ session('flash_message') }}
                </div>
            @endif
            <form action="{{ route('user.postLogin') }}" method="post">
                <div class="form-group">
                    <label for="user_name">ユーザー名</label>
                    <input type="text" id="user_name" name="user_name" class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">パスワード</label>
                    <input type="password" id="password" name="password" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary float-sm-right">ログイン</button>
                {{ csrf_field() }}
            </form>
        </div>
        <div class="col-md-3"></div>
    </div>
</div>
@endsection
