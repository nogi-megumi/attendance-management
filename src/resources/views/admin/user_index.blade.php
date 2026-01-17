@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/user_index.css')}}">
@endsection

@section('header-navi')
@include('layouts.navi-list')
@endsection

@section('content')
<div class="content">
    <h1 class="content-title">スタッフ一覧</h1>
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
                @foreach ($users as $user)
                <tr class="table__rows">
                    <td class="grid__item__second">{{$user->name}}</td>
                    <td class="grid__item__third">{{$user->email}}</td>
                    <td class="grid__item__fourth"><a class="" href="/attendance/detail/{{$attendance->id}}">詳細</a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection