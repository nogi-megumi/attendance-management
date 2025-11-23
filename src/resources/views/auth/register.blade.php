@extends('layouts.app')

@section('content')
<div class="content">
    <div class="title">会員登録</div>
    <div class="form-group">
        <form class="form" action="/register" method="POST">
            @csrf
            <div class="form-item">
                <label class="form-item__label" for="">名前</label>
                <input class="form-item__input" type="text">
                <p class="error-message">名前を入力してください</p>
            </div>
            <div class="form-item">
                <label class="form-item__label" for="">メールアドレス</label>
                <input class="form-item__input" type="text">
                <p class="error-message">メールアドレスを入力してください</p>
            </div>
            <div class="form-item">
                <label class="form-item__label" for="">パスワード</label>
                <input class="form-item__input" type="text">
                <p class="error-message">パスワードを入力してください</p>
            </div>
            <div class="form-item">
                <label class="form-item__label" for="">パスワード確認</label>
                <input class="form-item__input" type="text">
                <p class="error-message">パスワードが一致しません</p>
            </div>
            <div class="form-item">
                <button class="auth__button">登録する</button>
            </div>
        </form>
    </div>
    <div class="link">
        <a class="link--blue" href="/login">ログインはこちら</a>
    </div>
</div>

@endsection