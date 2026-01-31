@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/attendance_index.css')}}">
@endsection

@section('header-navi')
@include('layouts.navi-list')
@endsection

@section('content')
<div class="content">
    <h1 class="content-title">{{$targetDate->format('Y年m月d日')}}の勤怠</h1>
    <div class="management-data">
        <div class="pegination">
            <p><a class="pegination__link" href="?day={{$targetDate->copy()->subDay()->format('Y-m-d')}}">&larr;前日</a>
            </p>
            <p class="current">{{$targetDate->format('Y/m/d')}}</p>
            <p><a class="pegination__link" href="?day={{$targetDate->copy()->addDay()->format('Y-m-d')}}">翌日&rarr;</a>
            </p>
        </div>
        <div>
            <table class="table">
                <thead class="table__title">
                    <tr class="table__rows">
                        <th>名前</th>
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
                        <td>{{$attendance->user->name}}</td>
                        <td>{{$attendance->start_at ? $attendance->start_at->format('H:i'):""}}</td>
                        <td>{{$attendance->end_at ? $attendance->end_at->format('H:i'):""}}</td>
                        <td>{{$attendance->rest_total}}</td>
                        <td>{{$attendance->work_total}}</td>
                        @if (isset($attendance->id))
                        <td><a class="" href="/admin/attendance/{{$attendance->id}}">詳細</a></td>  
                        @else
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