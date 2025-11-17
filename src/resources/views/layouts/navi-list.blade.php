{{-- ログイン前は非表示 --}}
{{-- @auth --}}

<div class="header-navi">
    <ul class="navi-list">
        {{-- 出勤前から退勤前まで if(本日のattendanceレコードが無いor本日のattendanceレコード->end_timeがない)--}}
        <li class="navi-list__item"><a class="link--white" href="">勤怠</a></li>
        <li class="navi-list__item"><a class="link--white" href="">勤怠一覧</a></li>
        <li class="navi-list__item"><a class="link--white" href="">申請</a></li>
        <li class="navi-list__item">
            <form class="form" action="/logout" method="POST">
                @csrf
                <button class="navi-list__button">ログアウト</button>
            </form>
        </li>
        {{-- 退勤後　if(本日のattendanceレコード->end_timeがある)
        <li class="navi-list__item"><a href="">今月の出勤一覧</a></li>
        <li class="navi-list__item"><a href="">申請一覧</a></li>
        <li class="navi-list__item">
            <form class="form" action="/logout" method="POST">
                @csrf
                <button class="form__button">ログアウト</button>
            </form>
        </li>
        --}}
        {{-- 管理者ログイン時　if(ログインユーザーidがadminテーブルidに一致するとき)
        <li class="navi-list__item"><a href="">勤怠一覧</a></li>
        <li class="navi-list__item"><a href="">スタッフ一覧</a></li>
        <li class="navi-list__item"><a href="">申請一覧</a></li>
        <li class="navi-list__item">
            <form class="form" action="/logout" method="POST">
                @csrf
                <button class="form__button">ログアウト</button>
            </form>
        </li>
        --}}
    </ul>
</div>
{{-- @endauth --}}