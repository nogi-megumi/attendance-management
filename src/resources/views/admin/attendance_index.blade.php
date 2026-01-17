@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/attendance_index.css')}}">
@endsection

@section('header-navi')
@include('layouts.navi-list')
@endsection

@section('content')
<div class="content">
    <h1 class="content-title">勤怠一覧</h1>
    <div class="management-data">
        <div class="pegination">
            <p><a class="pegination__link" href="?month={{$targetDate->copy()->subMonth()->format('Y-m')}}">&larr;前月</a>
            </p>
            <p class="current">{{$targetDate->format('Y/m')}}</p>
            <p><a class="pegination__link" href="?month={{$targetDate->copy()->addMonth()->format('Y-m')}}">翌月&rarr;</a>
            </p>
        </div>
        <div>
            <table class="table">
                <thead class="table__title">
                    <tr class="table__rows">
                        <th>日付</th>
                        <th>出勤</th>
                        <th>退勤</th>
                        <th>休憩</th>
                        <th>合計</th>
                        <th>詳細</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($attendances as $attendance)
                    <tr class="table__rows">
                        @if (isset($attendance->id))
                        <td>{{$attendance->start_at->isoFormat('MM/DD(ddd)')}}</td>
                        <td>{{$attendance->start_at->format('H:i')}}</td>
                        <td>{{$attendance->end_at ? $attendance->end_at->format('H:i'):""}}</td>
                        <td>{{$attendance->rest_total}}</td>
                        <td>{{$attendance->work_total}}</td>
                        <td><a class="" href="/attendance/detail/{{$attendance->id}}">詳細</a></td>
                        @else
                        <td>{{$attendance->display_date->isoFormat('MM/DD(ddd)')}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="table__data--black">詳細</td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection