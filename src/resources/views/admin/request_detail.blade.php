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
        <form action="/stamp_correction_request/approve/{{$correct_request->id}}" method="POST">
            @csrf
            <div class="grid table">
                <div class="grid__item table__rows">
                    <label class="form-item__label" for="">名前</label>
                    <div class="grid__item__second grid__item--bold">{{$attendance->user->name}}</div>
                </div>
                <div class="grid__item table__rows">
                    <label class="form-item__label">日付</label>
                    <div class="grid__item__second grid__item--bold">{{$attendance->start_at->format('Y年')}}</div>
                    <div class="grid__item__fourth grid__item--bold">{{$attendance->start_at->format('m月d日')}}</div>
                </div>
                <div class="grid__item table__rows">
                    <label class="form-item__label">出勤・退勤</label>
                    <input type="hidden" name="updated_start_at" value="{{$correct_request->updated_start_at}}">
                    <input type="hidden" name="updated_end_at" value="{{$correct_request->updated_end_at}}">
                    <div class="form-item__input grid__item__second grid__item--bold">
                        {{$correct_request->updated_start_at->format('H:i')}}</div>
                    <span class="grid__item__third grid__item--bold">&sim;</span>
                    <div class="form-item__input grid__item__fourth grid__item--bold">
                        {{$correct_request->updated_end_at->format('H:i')}}</div>
                </div>
                @foreach ($correct_request->updated_rests as $index=>$rest)
                <div class="grid__item table__rows">
                    <label class="form-item__label">休憩{{$index==0 ? '' : ($index + 1)}}</label>
                    <input type="hidden" name="updated_rests[{{$index}}][id]" value="{{$rest['id']}}">
                    <input type="hidden" name="updated_rests[{{$index}}][start_at]" value="{{$rest['start_at']}}">
                    <input type="hidden" name="updated_rests[{{$index}}][end_at]" value="{{$rest['end_at']}}">
                    <div class="form-item__input grid__item__second grid__item--bold">{{$rest['start_at']}}
                    </div>
                    <span class="grid__item__third grid__item--bold">&sim;</span>
                    <div class="form-item__input grid__item__fourth grid__item--bold">{{$rest['end_at']}}
                    </div>
                </div>
                @endforeach
                @php
                $nextIndex=count($correct_request->updated_rests);
                @endphp
                <div class="grid__item table__rows">
                    <label class="form-item__label">休憩{{$nextIndex==0 ? '' : ($nextIndex + 1)}}</label>
                </div>
                <div class="grid__item table__rows">
                    <label class="form-item__label">備考</label>
                    <div class="grid__item__wide grid__item--bold">{{$correct_request->note}}</div>
                </div>
            </div>
            <div class="button-group__item">
                @if ($correct_request->status==1)
                <button class="form-button button--black">承認</button>
                @elseif($correct_request->status==2)
                <p class="form-button button--gray">承認済み</p>
                @endif
            </div>
        </form>
    </div>
</div>
@endsection