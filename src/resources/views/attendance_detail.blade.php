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
    <div class="management-data">
        {{-- {{dd($attendance)}} --}}
        <form action="">
            <div class="grid table">
                <div class="grid__item table__rows">
                    <label class="form-item__label" for="">名前</label>
                    <div class="grid__item__second grid__item--bold">{{$attendance->user->name}}</div>
                </div>
                <div class="grid__item table__rows">
                    <label class="form-item__label" for="">日付</label>
                    <div class="grid__item__second grid__item--bold">{{$attendance->start_at->format('Y年')}}</div>
                    <div class="grid__item__fourth grid__item--bold">{{$attendance->start_at->format('m月d日')}}</div>
                </div>
                <div class="grid__item table__rows">
                    <label class="form-item__label" for="">出勤・退勤</label>
                    <input class="form-item__input grid__item__second grid__item--bold" type="text" name=""
                        value="{{$attendance->start_at->format('H:i')}}">
                    <span class="grid__item__third grid__item--bold">&sim;</span>
                    <input class="form-item__input grid__item__fourth grid__item--bold" type="text" name=""
                        value="{{$attendance->end_at ? $attendance->end_at->format('H:i'):''}}">
                </div>
                @for ($index = 0; $index < 2; $index++)
                    @php
                        $rest=$attendance->rests->get($index);
                    @endphp

                    <div class="grid__item table__rows">
                        <label class="form-item__label" for="">休憩{{$index + 1}}</label>
                        <input type="hidden" name="rests[{{$index}}][id]" value="{{$rest->id ?? ''}}">
                        <input class="form-item__input grid__item__second grid__item--bold" type="text"
                            name="rests[{{$index}}][start_at]" value="{{old(" rests.$index.start_at", $rest ?
                            $rest->start_at->format('H:i'):'') }}">
                        <span class="grid__item__third grid__item--bold">&sim;</span>
                        <input class="form-item__input grid__item__fourth grid__item--bold" type="text"
                            name="rests[{{$index}}][end_at]" value="{{old(" rests.$index.end_at", ($rest &&
                            $rest->end_at) ? $rest->end_at->format('H:i'):'')
                        }}">
                    </div>
                    @endfor
                    <div class="grid__item table__rows">
                        <label class="form-item__label">備考</label>
                        <textarea class="grid__item__wide grid__item--bold" name="note" id="" cols="30" rows="3"
                            name="note" value="{{old('note')}}"></textarea>
                    </div>
            </div>
            {{-- @if ()
            テーブルにデータがあればメッセージに切り替える
            @endif --}}
            <div class="button-group__item">
                <button class="form-button button--black">修正</button>
                {{-- <p class="alart-message">&ast;承認待ちのため修正はできません</p> --}}
            </div>
        </form>
    </div>
</div>
@endsection