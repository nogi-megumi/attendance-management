@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/request_index.css')}}">
@endsection

@section('header-navi')
@include('layouts.navi-list')
@endsection

@section('content')
<div class="content">
    <h1 class="content-title">申請一覧</h1>
    <div class="tab-group">
        <a class="tab {{$tab==1 ? 'active':''}}" href="/stamp_correction_request/list/?tab=1">承認待ち</a>
        <a class="tab {{$tab==2 ? 'active':''}}" href="/stamp_correction_request/list/?tab=2">承認済み</a>
    </div>
    <div>
        <table class="table">
            <thead class="table__title">
                <tr class="table__rows">
                    <th>状態</th>
                    <th>名前</th>
                    <th>対象日時</th>
                    <th>申請理由</th>
                    <th>申請日時</th>
                    <th>詳細</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($attendances))
                @foreach ($attendances as $attendance)
                    @foreach ($attendance->stamp_correct_requests as $request)
                    <tr class="table__rows">
                        <td>@if ($request->status==1)
                            承認待ち
                            @elseif($request->status==2)
                            承認済み
                            @endif
                        </td>
                        <td>{{$attendance->user->name}}</td>
                        <td>{{$attendance->start_at->format('Y/m/d')}}</td>
                        <td>{{$request->note}}</td>
                        <td>{{$request->created_at->format('Y/m/d')}}</td>
                        <td><a class="" href="/attendance/detail/{{$attendance->id}}">詳細</a></td>
                    </tr>
                    @endforeach
                @endforeach
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection