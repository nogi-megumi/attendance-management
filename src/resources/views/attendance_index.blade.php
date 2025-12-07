@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/attendance_index.css')}}">
@endsection

@section('header-navi')
@include('layouts.navi-list')
@endsection

@section('content')
<div class="content">
    {{-- admin時 2025年11月30日の勤怠 --}}
    <h1 class="content-title">勤怠一覧</h1>
    <div class="management-data">
        <div class="pegination">
            {{-- admin時
            前日　今日の日付　翌日
            --}}
            <p><a class="pegination__link">&larr;前月</a></p>
            <p class="current">2025/11</p>
            <p><a class="pegination__link">翌月&rarr;</a></p>
        </div>
        <div>
            <table class="table">
                <thead class="table__title">
                    <tr class="table__rows">
                        {{-- admin時 名前 --}}
                        <th>日付</th>
                        <th>出勤</th>
                        <th>退勤</th>
                        <th>休憩</th>
                        <th>合計</th>
                        <th>詳細</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="table__rows">
                        {{-- admin時 スタッフの名前 --}}
                        <td>11/01&#65288;土&#65289;</td>
                        <td>09:00</td>
                        <td>18:00</td>
                        <td>01:00</td>
                        <td>08:00</td>
                        <td><a class="link--bold" href="">詳細</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection