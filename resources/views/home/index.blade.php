@extends('layout')
@section('content')
    <h1>ChatWork一括送信</h1>
    <hr>
    <!-- 送信時のフラッシュメッセージ -->
    @if (session('flash_message'))
        <div class="alert alert-success" role="alert">
            {{ session('flash_message') }}
        </div>
    @endif
    @if (session('flash_error_message'))
        <div class="alert alert-danger" role="alert">
            {{ session('flash_error_message') }}
        </div>
    @endif
    <!-- カテゴリを使った顧客のソート -->
    <form action="{{route('home.index')}}" id="select-form">
        <select class="form-select" aria-label=".form-select-lg example" id="category" name="category_id" onchange="submit(this.form)">
            <option value="0" selected>全て</option>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == $customerCategoryId ? 'selected':'' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <div class="overflow-auto" style="height:400px;">
            <table class="table table-bordered">
                <thead>
        　        <tr class="text-center">
                        <th><label>ALL<br /><input type="checkbox" id="all"></label></th>
                        <th scope="col">顧客名</th>
                    </tr>
                </thead>
                <tbody id="boxes" class="table table-striped">

                @foreach ($customers as $customer)
                    <tr class="text-center">
                        <a href="">
                            <td style="width: 5%">
                                <input type ="checkbox" name="selectcustomer[]" value="{{ $customer->cw_id }}" {{ in_array($customer->cw_id, $selectCheckbox)  ? 'checked':'' }}>
                            </td>
                        </a>
                        <td scope="row">{{ $customer->name }}</td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
        <!-- タイトルを使った定型文の表示 -->
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" id="basic-addon1">タイトル</span>
            </div>
            <select class="form-control" name="message_id" aria-label="Default select example" onchange="submit(this.form)">
                @foreach ($messages as $message)
                    <option value="{{ $message->id }}" {{ $message->id == $selectmessage->id ? 'selected':'' }} >
                        {{ $message->title }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="input-group" style="height: 250px;">
            <div class="input-group-prepend">
                <span class="input-group-text" style="padding: 20px;">定型文</span>
            </div>
            <textarea class="form-control" name="message" value="" aria-label="message">{{ $selectmessage->name ?? "" }}</textarea>
        </div>
    </form>

    <form id="hide-form" action="{{route('home.send')}}" method="post">
    @csrf
        <div class="container" style="width: 200px;">
            <button type="button" class="mb-2 btn btn-primary w-75 h-50 my-5" id="sub" onclick='return confirm("本当に送信しますか？");'>送信</button>
        </div>
        <textarea name="postMessage" id="hideMessage" style="display: None"></textarea>
    </form>

    <div class="product-list">
        <table class="product datatable table table-bordered table-sorted text-center">
            <thead>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
@endsection
