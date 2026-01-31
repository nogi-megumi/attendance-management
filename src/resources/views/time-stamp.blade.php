@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/time-stamp.css')}}">
@endsection

@section('header-navi')
@include('layouts.navi-list')
@endsection

@section('content')
<div class="content">
    <div class="status-block"><span class="status">
            @if ($workStatus==1)
            勤務外
            @elseif($workStatus==2)
            勤務中
            @elseif($workStatus==3)
            休憩中
            @elseif($workStatus==4)
            退勤済
            @endif</span>
    </div>
    <div class="date">{{$today->isoFormat('YYYY年MM月DD日(ddd)')}}</div>
    <div class="time">{{$today->isoFormat('HH:mm')}}</div>
    <div class="button-group">
        @switch($workStatus)
        @case(1)
        <div class="button-group__item">
            <form action="/attendance" method="POST">
                @csrf
                <button class="button button--black">出勤</button>
            </form>
        </div>
        @break
        @case(2)
        <div class="button-group__item">
            <form action="/attendance" method="POST">
                @csrf
                @method('PUT')
                @if(isset($workData))
                <input type="hidden" name="id" value="{{$workData->id}}">
                @endif
                <button class="button button--black">退勤</button>
            </form>
        </div>
        <div class="button-group__item">
            <form action="/rest" method="POST">
                @csrf
                <input type="hidden" name="attendance_id" value="{{$workData->id}}">
                <button class="button button--white">休憩入</button>
            </form>
        </div>
        @break
        @case(3)
        <form action="/rest" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="attendance_id" value="{{$workData->id}}">
            <button class="button button--white">休憩戻</button>
        </form>
        @break
        @case(4)
        <div class="message">お疲れ様でした。</div>
        @break
        @endswitch
    </div>
    @endsection