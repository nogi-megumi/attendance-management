@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/time-stamp.css')}}">
@endsection

@section('header-navi')
@include('layouts.navi-list')
@endsection

@section('content')
<div class="content">
    <div class="status-block"><span class="status">勤務中</span></div>
    <div class="date">2025年11月16日（日）</div>
    <div class="time">08:30</div>
    <div class="button-group">
        <div class="button-group__item"><a class="button button--black" href="">退勤</a></div>
        <div class="button-group__item"><a class="button button--white" href="">休憩入</a></div>
    </div>
    {{-- 退勤後の表示画面
    <div class="message">お疲れ様でした</div> --}}
</div>
@endsection