@extends('layouts.app')

@section('content')
<div class="content">

    @if (Route::is('admin.login'))
    <div class="title">管理者ログイン</div>
    @else
    <div class="title">ログイン</div>
    @endif
    <div class="form-group">
        <form class="form" action="{{isset($guard) ? route('admin.login') : route('login')}}" method="POST">
            @csrf
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
            @if (Route::is('admin.login'))
            <div>
                <button class="auth__button">管理者ログインする</button>
            </div>
            @else
            <div class="form-item">
                <button class="auth__button">ログインする</button>
            </div>
            @endif
        </form>
    </div>
    @if (Route::is('login'))
    <div class="link">
        <a class="link--blue" href="/register">会員登録はこちら</a>
    </div>
    @endif
</div>

@endsection