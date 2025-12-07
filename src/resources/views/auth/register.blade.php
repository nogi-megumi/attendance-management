@extends('layouts.app')

@section('content')
<div class="content">
    <div class="title">会員登録</div>
    <div class="form-group">
        <form class="form" action="/register" method="POST">
            @csrf
            <div class="form-item">
                <label class="form-item__label" for="name">名前</label>
                <input class="form-item__input" type="text" name="name" value="{{old('name')}}">
                <p class="error-message">
                    @error('name')
                    {{$message}}
                    @enderror
                </p>
            </div>
            <div class="form-item">
                <label class="form-item__label" for="email">メールアドレス</label>
                <input class="form-item__input" type="email" name="email" value="{{old('email')}}">
                <p class="error-message">
                    @error('email')
                    {{$message}}
                    @enderror
                </p>
            </div>
            <div class="form-item">
                <label class="form-item__label" for="password">パスワード</label>
                <input class="form-item__input" type="password" name="password">
                <p class="error-message">
                    @error('password')
                    {{$message}}
                    @enderror
                </p>
            </div>
            <div class="form-item">
                <label class="form-item__label" for="password_confirmation">パスワード確認</label>
                <input class="form-item__input" type="password" name="password_confirmation">
                <p class="error-message">
                    @error('password')
                    {{$message}}
                    @enderror
                </p>
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