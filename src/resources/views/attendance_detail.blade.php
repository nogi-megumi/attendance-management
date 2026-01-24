@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/attendance_detail.css')}}">
@endsection

@section('header-navi')
@include('layouts.navi-list')
@endsection

@section('content')
<div class="content">
    <h1 class="content-title">勤怠詳細</h1>
    @php
    $latestRequest=$attendance->stamp_correct_requests->last();
    @endphp

    @if ($latestRequest && $latestRequest->status==1)
    <div class="grid table">
        <div class="grid__item table__rows">
            <p class="form-item__label">名前</p>
            <div class="grid__item__second grid__item--bold">{{$attendance->user->name}}</div>
        </div>
        <div class="grid__item table__rows">
            <p class="form-item__label">日付</p>
            <div class="grid__item__second grid__item--bold">{{$attendance->start_at->format('Y年')}}</div>
            <div class="grid__item__fourth grid__item--bold">{{$attendance->start_at->format('m月d日')}}</div>
        </div>
        <div class="grid__item table__rows">
            <p class="form-item__label">出勤・退勤</p>
            <p class="grid__item__second grid__item--bold">
                {{$latestRequest->updated_start_at->format('H:i')}}</p>
            <span class="grid__item__third grid__item--bold">&sim;</span>
            <p class="grid__item__fourth grid__item--bold">
                {{$latestRequest->updated_end_at->format('H:i')}}</p>
        </div>
        @foreach ($latestRequest->updated_rests as $index=>$rest)
        <div class="grid__item table__rows">
            <p class="form-item__label">休憩{{$index==0 ? '' : ($index + 1)}}</p>
            <p class="grid__item__second grid__item--bold">{{$rest['start_at']}}</p>
            <span class="grid__item__third grid__item--bold">&sim;</span>
            <p class="grid__item__fourth grid__item--bold">{{$rest['end_at']}}</p>
        </div>
        @endforeach
        <div class="grid__item table__rows">
            <p class="form-item__label">備考</p>
            <p class="grid__item__wide grid__item--bold">{{$latestRequest->note}}</p>
        </div>
    </div>
    <div class="button-group__item">
        <p class="alart-message">&ast;承認待ちのため修正はできません</p>
    </div>

    @else
        @if ($errors->any())
        <ul class="error-message">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif
    <div class="management-data">
        <form action="/stamp_correction_request" method="POST">
            @csrf
            <div class="grid table">
                <div class="grid__item table__rows">
                    <label class="form-item__label">名前</label>
                    <div class="grid__item__second grid__item--bold">{{$attendance->user->name}}</div>
                </div>
                <div class="grid__item table__rows">
                    <label class="form-item__label">日付</label>
                    <div class="grid__item__second grid__item--bold">{{$attendance->start_at->format('Y年')}}</div>
                    <div class="grid__item__fourth grid__item--bold">{{$attendance->start_at->format('m月d日')}}</div>
                </div>
                <div class="grid__item table__rows">
                    <label class="form-item__label">出勤・退勤</label>
                    <input type="hidden" name="attendance_id" value="{{$attendance->id}}">
                    <input class="form-item__input grid__item__second grid__item--bold" type="text"
                        name="updated_start_at"
                        value="{{old('updated_start_at',$attendance->start_at->format('H:i'))}}">
                    <span class="grid__item__third grid__item--bold">&sim;</span>
                    <input class="form-item__input grid__item__fourth grid__item--bold" type="text"
                        name="updated_end_at"
                        value="{{old('updated_end_at',$attendance->end_at ? $attendance->end_at->format('H:i'):'')}}">
                </div>

                @php
                $rests=$attendance->rests;
                @endphp
                @foreach ($rests as $index=>$rest)
                <div class="grid__item table__rows">
                    <label class="form-item__label">休憩{{$index==0 ? '' : ($index + 1)}}</label>
                    <input type="hidden" name="rests[{{$index}}][id]" value="{{$rest->id}}">
                    <input class="form-item__input grid__item__second grid__item--bold" type="text"
                        name="rests[{{$index}}][start_at]" value="{{old(" rests.$index.start_at", $rest ?
                        $rest->start_at->format('H:i'):'') }}">
                    <span class="grid__item__third grid__item--bold">&sim;</span>
                    <input class="form-item__input grid__item__fourth grid__item--bold" type="text"
                        name="rests[{{$index}}][end_at]" value="{{old(" rests.$index.end_at", ($rest && $rest->end_at) ?
                    $rest->end_at->format('H:i'):'')}}">
                </div>
                @endforeach
                
                @php
                $nextIndex=count($rests);
                @endphp
                <div class="grid__item table__rows">
                    <label class="form-item__label">休憩{{$nextIndex==0 ? '' : ($nextIndex + 1)}}</label>
                    <input type="hidden" name="rests[{{$nextIndex}}][id]" value="">
                    <input class="form-item__input grid__item__second grid__item--bold" type="text"
                        name="rests[{{$nextIndex}}][start_at]" value="{{old(" rests.$nextIndex.start_at")}}">
                    <span class="grid__item__third grid__item--bold">&sim;</span>
                    <input class="form-item__input grid__item__fourth grid__item--bold" type="text"
                        name="rests[{{$nextIndex}}][end_at]" value="{{old(" rests.$nextIndex.end_at")}}">
                </div>
                <div class="grid__item table__rows">
                    <label class="form-item__label">備考</label>
                    <textarea class="grid__item__wide grid__item--bold" name="note" cols="30" rows="3" value="{{old("
                        note")}}"></textarea>
                </div>
            </div>
            <div class="button-group__item">
                <button class="form-button button--black">修正</button>
            </div>
        </form>
        @endif
    </div>
</div>
@endsection