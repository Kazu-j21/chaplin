@extends('layout')

@section('content')
    <h1>顧客一覧</h1>
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
            <div class="col-10" style="padding:20px 0; padding-left:0px;">
                <form class="form-inline" action="{{url('/customer')}}">
                    <div class="form-group">
                        <label for="customer_keyword">顧客検索：</label>
                        <input type="text" name="customer_keyword" value="{{ request('customer_keyword') }}" class="form-control" placeholder="名前を入力してください">
                    </div>
                    <div class="form-group">
                        <label for="category_keyword">カテゴリ検索：</label>
                        <input type="text" name="category_keyword" value="{{ request('category_keyword') }}" class="form-control" placeholder="名前を入力してください">
                    </div>
                    <div class="form-group">
                        <label for="cw_id_keyword">CW_ID検索：</label>
                        <input type="text" name="cw_id_keyword" value="{{ request('cw_id_keyword') }}" class="form-control" placeholder="名前を入力してください">
                    </div>
                    <div class="form-group">
                        <input type="submit" value="検索" class="btn btn-info">
                    </div>
                </form>
            </div>
            <!--↑↑ 検索フォーム ↑↑-->
       
            <div class="col-2 text-right pt-4">
                <a href="{{ route('customer.create') }}">
                    <button class="m-2 btn btn-primary">登録</button>
                </a>
            </div>
        </div>
    </div>
    <div class="col">
        <table class="product datatable table table-bordered table-sorted text-center">
            <thead class="table">
                <tr>
                    <td>@sortablelink('name', '顧客名')</td>
                    <td>カテゴリ</td>
                    <td>@sortablelink('cw_id', 'CWルームID')</td>
                    <td>操作</td>
                </tr>
            </thead>
            <tbody>
                @foreach ($customers as $customer)
            　　    <tr>
                        <td>{{ $customer->name }}</td>
                        <td>{{ $customer->category_id == '0' ? '':$customer->categories->name }}</td>   
                        <td>{{ $customer->cw_id }}</td> 
                        <td><a class="btn btn-sm btn-primary" href="{{ route('customer.edit', $customer->id) }}">編集</a></td>
                   </tr>       
                 @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-center paginate mt-5">
            {{ $customers->links() }}
        </div>
    </div>
@endsection




