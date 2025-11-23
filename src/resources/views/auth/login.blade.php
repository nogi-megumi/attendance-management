@extends('layouts.app')

@section('content')
<div class="content">
    <div class="title">ログイン</div>
    {{-- 管理者の時
    <div class="title">管理者ログイン</div> --}}
    <div class="form-group">
        <form class="form" action="/login" method="POST">
            @csrf
            {{-- <form class="form" action="/admin/login" method="POST"> --}}
                <div class="form-item">
                    <label class="form-item__label" for="">メールアドレス</label>
                    <input class="form-item__input" type="text">
                    <p class="error-message"></p>
                </div>
                <div class="form-item">
                    <label class="form-item__label" for="">パスワード</label>
                    <input class="form-item__input" type="text">
                    <p class="error-message"></p>
                </div>
                <div class="form-item">
                    <button class="auth__button">ログインする</button>
                </div>
                {{--
                <div>
                    <button class="auth__button">管理者ログインする</button>
                </div> --}}
            </form>
    </div>
    <div class="link">
        <a class="link--blue" href="/register">会員登録はこちら</a>
    </div>
</div>

@endsection