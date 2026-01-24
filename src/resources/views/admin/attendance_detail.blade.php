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
        <form action="/stamp_correction_request" method="POST">
            @csrf
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
                    <input class="form-item__input grid__item__second grid__item--bold" type="text"
                        name="updated_start_at" value="{{$attendance->start_at->format('H:i')}}">
                    <span class="grid__item__third grid__item--bold">&sim;</span>
                    <input class="form-item__input grid__item__fourth grid__item--bold" type="text"
                        name="updated_end_at" value="{{$attendance->end_at ? $attendance->end_at->format('H:i'):''}}">
                </div>
                @error('updated_end_at')
                <p>{{$message}}</p>
                @enderror
                @php
                $rests=$attendance->rests;
                @endphp
                @foreach ($rests as $index=>$rest)
                <div class="grid__item table__rows">
                    <label class="form-item__label" for="">休憩{{$index==0 ? '' : ($index + 1)}}</label>
                    <input type="hidden" name="rests[{{$index}}][id]" value="{{$rest->id}}">
                    <input class="form-item__input grid__item__second grid__item--bold" type="text" {{}}
                        name="rests[{{$index}}][start_at]" value="{{old(" rests.$index.start_at", $rest ?
                        $rest->start_at->format('H:i'):'') }}">
                    <span class="grid__item__third grid__item--bold">&sim;</span>
                    <input class="form-item__input grid__item__fourth grid__item--bold" type="text"
                        name="rests[{{$index}}][end_at]" value="{{old(" rests.$index.end_at", ($rest && $rest->end_at) ?
                    $rest->end_at->format('H:i'):'')}}">
                </div>
                @error('rests[{{$index}}][start_at]')
                <p>{{$message}}</p>
                @enderror
                @error('rests[{{$index}}][end_at]')
                <p>{{$message}}</p>
                @enderror
                @endforeach
                @php
                $nextIndex=count($rests);
                @endphp
                <div class="grid__item table__rows">
                    <label class="form-item__label" for="">休憩{{$nextIndex==0 ? '' : ($nextIndex + 1)}}</label>
                    <input type="hidden" name="rests[{{$nextIndex}}][id]" value="">
                    <input class="form-item__input grid__item__second grid__item--bold" type="text"
                        name="rests[{{$nextIndex}}][start_at]" value="{{old(" rests.$nextIndex.start_at") }}">
                    <span class="grid__item__third grid__item--bold">&sim;</span>
                    <input class="form-item__input grid__item__fourth grid__item--bold" type="text"
                        name="rests[{{$nextIndex}}][end_at]" value="{{old(" rests.$nextIndex.end_at")}}">
                </div>
                @error('rests[{{$nextIndex}}][start_at]')
                <p>{{$message}}</p>
                @enderror
                @error('rests[{{$nextIndex}}][end_at]')
                <p>{{$message}}</p>
                @enderror
                <div class="grid__item table__rows">
                    <label class="form-item__label">備考</label>
                    <textarea class="grid__item__wide grid__item--bold" name="note" cols="30" rows="3"
                        value="{{old('note')}}"></textarea>
                </div>
                @error('note')
                <p>{{$message}}</p>
                @enderror
            </div>
            <div class="button-group__item">
                <button class="form-button button--black">修正</button>
            </div>
        </form>

        @if (isset($attendance->stamp_correction_requests()))
        <form action="" method="post">
            @csrf
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
                    <p class="grid__item__second grid__item--bold">
                        {{$attendance->stamp_correction_requests()->update_start_at->format('H:i')}}</p>
                    <span class="grid__item__third grid__item--bold">&sim;</span>
                    <p class="grid__item__fourth grid__item--bold">
                        {{$attendance->stamp_correction_requests()->update_end_at->format('H:i')}}</p>
                </div>
                @php
                $rests=$attendance->stamp_correction_requests()->update_rests;
                @endphp
                @foreach ($rests as $index=>$rest)
                <div class="grid__item table__rows">
                    <label class="form-item__label" for="">休憩{{$index==0 ? '' : ($index + 1)}}</label>
                    <p class="grid__item__second grid__item--bold">{{$rest->start_at->format('H:i')}}</p>
                    <span class="grid__item__third grid__item--bold">&sim;</span>
                    <p class="grid__item__fourth grid__item--bold">{{$rest->end_at->format('H:i')}}</p>
                </div>
                @endforeach
                <div class="grid__item table__rows">
                    <label class="form-item__label">備考</label>
                    <p class="grid__item__wide grid__item--bold">{{$attendance->stamp_correction_requests()->note}}</p>
                </div>
            </div>
            <div class="button-group__item">
                @if ($attendance->stamp_correction_requests()->status==1)
                <button class="form-button button--black">承認</button>
                @elseif($attendance->stamp_correction_requests()->status==2)
                <p class="form-button button--black">承認済み</p>
                @endif
            </div>
        </form>
        @endif
    </div>
</div>
@endsection