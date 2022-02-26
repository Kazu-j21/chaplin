@extends('layout')

@section('content')
    <h1>メッセージ一覧</h1>
    <hr>
    <!-- 商品登録時のフラッシュメッセージ -->
    @if (session('flash_message'))
        <div class="alert alert-success" role="alert">
            {{ session('flash_message') }}
        </div>
    @endif
    <div class="text-right">
        <a href="{{ route('message.create') }}">
            <button type ="button" class="btn btn-primary">登録</button>
        </a>   
    </div>
    <table class="table table-bordered">
     <thead>  
      　<tr class="text-center">
         <th scope="col">@sortablelink('title', 'タイトル')</th>
         <th scope="col">操作</th>
        </tr>
     </thead>
     <tbody>
         @foreach ($messages as $message)
         <tr class="text-center">
            <td scope="row">{{ $message->title }}</td>
            <form action="{{ route('message.edit', $message->id) }}" method="get">
            @csrf
                <td> <button type ="submit" class="btn btn-primary">編集</button></td>
            </form>
         </tr>
         @endforeach
     </tbody>
    </table>
    <div class="d-flex justify-content-center paginate mt-5">
        {{ $messages->links() }}
    </div>
@endsection
