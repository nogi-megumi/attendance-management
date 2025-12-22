<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Rest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AttendanceController extends Controller
{
    public function index(){
        // 勤怠一覧画面を表示する
        // attendancesからuser_idが一致する、今月分のデータを取得する。
        // restsからattendancesと紐づいたデータを取得する。
        // attendancesのend_atとstart_atの差分を計算する。これをwork_timeとする。
        // restsのend_atとstart_atの差分を計算し、これをrest_timeとする。
        // work_timeとrest_timeの差分を計算する。
        $user = Auth::user();
        $month=Carbon::today()->isoFormat('YYYY/MM');
        $workData=Attendance::whereDate('created_at', $month)->where('user_id', $user->id)->get();
        $restData=Rest::whereDate('created_at', $month)->where('attendance_id', $workData->id)->get();
        return view('attendance_index',compact('workData'));
    }

    public function show()
    {
        // 勤怠詳細を表示する
        return view('attendance_detail');
    }
}
