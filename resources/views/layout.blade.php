<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>
    <!-- bootstrap導入 -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-sm navbar-toggleable-sm navbar-light border-bottom box-shadow header-bg">
            <div class="container header-container">
                <a class="navbar-brand header-logo" href="{{ route("home.index") }}">Chaplin（チャットワーク一括送信システム）</a>
                @if (strpos(url()->current(), 'login') === false)
                <div class="navbar-collapse collapse d-sm-inline-flex flex-sm-row-reverse">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="nav-item mr-3 font-weight-bold">{{ BydAuth::user()['name'] }}</li>
                        <li><a class="btn btn-danger btn-sm" href="{{ route("user.logout") }}">ログアウト</a></li>
                    </ul>
                </div>
                @endif
            </div>
        </nav>
    </header>
    @if(strpos(url()->current(), 'login') === false)
    <div class="wrapper">
        <nav id="sidebar">
            <ul class="list-unstyled">
                <li @if (url()->current() == route('home.index')) class="active" @endif>
                    <a href="{{ route('home.index') }}">チャットワーク一括送信</a>
                </li>
                <li @if (url()->current() == route('customer.index')) class="active" @endif>
                    <a href="{{ route('customer.index') }}">顧客管理</a>
                </li>
                <li @if (url()->current() == route('category.index')) class="active" @endif>
                    <a href="{{ route('category.index') }}">カテゴリ管理</a>
                </li>
                <li @if (url()->current() == route('message.index')) class="active" @endif>
                    <a href="{{ route('message.index') }}">メッセージ管理</a>
                </li>
                <li @if (url()->current() == route('log.index')) class="active" @endif>
                    <a href="{{ route('log.index') }}">操作ログ履歴</a>
                </li>
            </ul>
        </nav>
    </div>
    @endif
    <div id="content">
        @yield('content')
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    <script>
    $(function() {
        // 1. 「全選択」する
        $('#all').on('click', function() {
            $("input[name='selectcustomer[]']").prop('checked', this.checked);
        });
            // 2. 「全選択」以外のチェックボックスがクリックされたら、
        $("input[name='selectcustomer[]']").on('click', function() {
            if ($('#boxes :checked').length == $('#boxes :input').length) {
                // 全てのチェックボックスにチェックが入っていたら、「全選択」 = checked
                $('#all').prop('checked', true);
            } else {
                // 1つでもチェックが入っていたら、「全選択」 = checked
                $('#all').prop('checked', false);
            }
        });
    });
    </script>

    <script>
        const checkedCustomers = [];
        $(function(){
            $('#sub').on('click', function() {
                $('#sub').prop('disabled', 'true');
                checkedCustomers.length = 0;
                // チェックされている要素のidを配列に入れる
                $("#select-form [name='selectcustomer[]']:checked").each(function(){
                    checkedCustomers.push($(this).val());
                });
                var message = $('#select-form [name=message]').val();
                $('#hideMessage').val(message);
                // 顧客情報を別フォームに挿入
                $.each(checkedCustomers, function(index, customerId){
                    $('#hide-form').append(`<input type="hidden" name="postCustomers[]" value="${customerId}">`);
                });

                $('#hide-form').submit();
            });
        });
    </script>

</body>
</html>
<style>
/**
 ヘッダー
*/
header {
    position: fixed;
    width: 100%;
    z-index: 1000;
}

.header-container{
    max-width: 98%;
    padding-left: 0;
}

.header-logo {
    font-weight: bold;
    display: block;
}

.header-bg {
    background-color: #C9DAF8;
}

/**
    サイドメニュー
*/
.wrapper {
    display: flex;
    align-items: stretch;
}

#sidebar {
    width: 200px;
    position: fixed;
    top: 53px;
    left: 0;
    height: 100vh;
    z-index: 999;
    background: #EEEEEE;
    color: #fff;
    transition: all 0.3s;
}

#sidebar ul li a {
    color: #005E9C;
    font-weight: bold;
    padding: 20px;
    font-size: 13px;
    display: block;
    border-bottom: solid 1px #CCCCCC;
}

#sidebar ul li a:hover {
    color: #000;
    background: #CCCCCC;
    text-decoration: none;
}

#sidebar ul li.active > a {
    color: #fff;
    background: #1BA1E2;
}

#sidebar ul ul a {
    font-size: 0.75em !important;
    padding-left: 30px !important;
    background: #EEEEEE;
    padding-top: 14px !important;
    padding-bottom: 14px !important;
}

/**
    本文
*/
#content {
    width: calc(100% - 200px);
    padding-top: 10px;
    padding-left: 40px;
    padding-right: 40px;
    min-height: 100vh;
    transition: all 0.3s;
    position: absolute;
    top: 53px;
    right: 0;
}

#content-login {
    width: calc(100% - 200px);
    padding-top: 10px;
    padding-left: 40px;
    padding-right: 260px;
    min-height: 100vh;
    transition: all 0.3s;
    position: absolute;
    top: 53px;
    right: 0;
}

/**
    見出し
*/
h1 {
    display: inline-block;
    font-size: 30px;
    margin-top: 40px;
    margin-bottom: 20px;
    padding-bottom: 5px;
    border-bottom: solid 2px #CCCCCC;
}

h2 {
    font-size: 22px;
    color: #1C4587;
}

/**
    フォーム関連のデザイン調整
*/
.item-group-bg {
    background: #C9DAF8;
    padding: 8px;
    margin-bottom: 30px;
    border-radius: 5px;
}
.item-group-bg .item-group {
    background: #FFF;
    margin: 0;
    padding: 10px;
}
.item-group-bg .btn-area {
    padding: 0;
    margin-bottom: 0;
    margin-top: 8px;
}

.item-group-bg label:not(.form-check-label) {
    min-width: 9em;
    display: inline-block;
    margin-right: 5px;
    padding-bottom: 4px;
    border-bottom: 1px dashed #CCC;
    font-size: 1.1em;
    color: #3C78D8;
    line-height: 30px;
    font-weight: normal;
}

.item-group-bg label.student-regist {
    min-width: 4em;
}

.item-group-bg label.regist-person {
    min-width: 11em;
}

.item-group-bg label.edit-user {
    min-width: 13em;
}

.item-group-list {
    padding: 10px;
    margin: 10px 0;
    border: solid 1px #000;
    border-radius: 5px;
    margin-bottom: 30px;
}

.form-group {
    padding-bottom: 10px;
    padding-left: 10px;
    margin-top: 10px;
    margin-bottom: 10px;
}

.form-group p {
    display: inline-block;
    margin-left: 0px;
    font-size: 20px;
    margin-bottom: 0;
    font-weight: normal;
    color: #3C78D8;
    padding-bottom: 4px;
    font-weight: bold;
}

.form-group .text-danger {
    margin-left: 10px;
}

.form-group p.contract {
    font-size: 22px;
}

.form-item-name {
    display: block !important;
    font-weight: bold;
    margin: auto 0;
}

.checkbox-width {
    width: 86px;
    justify-content: left !important;
}
</style>

@if (strpos(url()->current(), 'login'))
<style>
#content {
    width: 100%;
    padding-top: 50px;
    padding-left: 0;
    padding-right: 0;
    min-height: 0;
    transition: none;
    position: static;
}
</style>
@endif
