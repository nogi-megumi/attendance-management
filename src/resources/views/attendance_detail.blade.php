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
        <form action="">
            <div class="grid table">
                <div class="grid__item table__rows">
                    <label class="form-item__label" for="">名前</label>
                    <div class="grid__item__second grid__item--bold">西麗奈</div>
                </div>
                <div class="grid__item table__rows">
                    <label class="form-item__label" for="">日付</label>
                    <div class="grid__item__second grid__item--bold">2025年</div>
                    <div class="grid__item__fourth grid__item--bold">11月1日</div>
                </div>
                <div class="grid__item table__rows">
                    <label class="form-item__label" for="">出勤・退勤</label>
                    <input class="form-item__input grid__item__second grid__item--bold" type="text">
                    <span class="grid__item__third grid__item--bold">&sim;</span>
                    <input class="form-item__input grid__item__fourth grid__item--bold" type="text">
                </div>
                <div class="grid__item table__rows">
                    <label class="form-item__label" for="">休憩</label>
                    <input class="form-item__input grid__item__second grid__item--bold" type="text">
                    <span class="grid__item__third grid__item--bold">&sim;</span>
                    <input class="form-item__input grid__item__fourth grid__item--bold" type="text">
                </div>
                <div class="grid__item table__rows">
                    <label class="form-item__label" for="">休憩2</label>
                    <input class="form-item__input grid__item__second grid__item--bold" type="text">
                    <span class="grid__item__third grid__item--bold">&sim;</span>
                    <input class="form-item__input grid__item__fourth grid__item--bold" type="text">
                </div>
                <div class="grid__item table__rows">
                    <label class="form-item__label" for="">備考</label>
                    <textarea class="grid__item__wide grid__item--bold" name="" id="" cols="30"
                        rows="5">電車遅延のため</textarea>
                </div>
            </div>
            <div class="button-group__item">
                <button class="form-button button--black">修正</button>
                {{-- <p class="alart-message">&ast;承認待ちのため修正はできません</p> --}}
            </div>
        </form>
    </div>
</div>
@endsection