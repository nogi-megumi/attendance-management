<div class="header-navi">
    <ul class="navi-list">
        @if (Auth::guard('admin')->check())
        <li class="navi-list__item"><a class="link--white" href="/admin/attendance/list">勤怠一覧</a></li>
        <li class="navi-list__item"><a class="link--white" href="/admin/staff/list">スタッフ一覧</a></li>
        <li class="navi-list__item"><a class="link--white" href="/stamp_correction_request/list">申請一覧</a></li>
        <li class="navi-list__item">
            <form class="form" action="/admin/logout" method="POST">
                @csrf
                <button class="navi-list__button">ログアウト</button>
            </form>
        </li>
        @elseif(Auth::guard('web')->check())

        @if(($workStatus ?? '未設定')==='退勤済')
        <li class="navi-list__item"><a class="link--white" href="/attendance/list">今月の出勤一覧</a></li>
        <li class="navi-list__item"><a class="link--white" href="/stamp_correction_request/list">申請一覧</a></li>
        @else
        <li class="navi-list__item"><a class="link--white" href="/">勤怠</a></li>
        <li class="navi-list__item"><a class="link--white" href="/attendance/list">勤怠一覧</a></li>
        <li class="navi-list__item"><a class="link--white" href="/stamp_correction_request/list">申請</a></li>
        @endif
        <li class="navi-list__item">
            <form class="form" action="/logout" method="POST">
                @csrf
                <button class="navi-list__button">ログアウト</button>
            </form>
        </li>
        @endif
    </ul>
</div>