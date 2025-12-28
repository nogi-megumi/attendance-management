@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/user_index.css')}}">
@endsection

@section('header-navi')
@include('layouts.navi-list')
@endsection

@section('content')
<div class="content">
    <h1 class="content-title">勤怠一覧</h1>
    <div class="management-data">
        <table class="table">
            <thead class="table__title">
                <tr class="table__rows">
                    <th class="grid__item__second">名前</th>
                    <th class="grid__item__third">メールアドレス</th>
                    <th class="grid__item__fourth">月次勤怠</th>
                </tr>
            </thead>
            <tbody>
                <tr class="table__rows">
                    <td class="grid__item__second">西怜奈</td>
                    <td class="grid__item__third">reina.n@coathtech.com</td>
                    <td class="grid__item__fourth"><a class="" href="/attendance/detail/{{$attendance->id}}">詳細</a></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection