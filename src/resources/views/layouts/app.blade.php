<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>勤怠管理</title>
    <link rel="stylesheet" href="{{asset('css/common.css')}}">
    <link rel="stylesheet" href="{{asset('css/sanitize.css')}}">
    @yield('css')
</head>

<body>
    <div class="app">
        <header>
            <div class="header-logo">
                <div class="img-box">
                    <img class="img-box__img" src="{{asset('img/logo.svg')}}" alt="coachtech">
                </div>
            </div>
            @yield('header-navi')
        </header>
        <main>
            @yield('content')
        </main>
    </div>
</body>

</html>