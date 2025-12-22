<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Attendance;
use App\Models\Rest;


class RestController extends Controller
{
    public function store(Request $request)
    {
        // 休憩ボタンを押したら、restレコードを作成する
        // user_id、work_id、start_atにデータを登録する
        // attendanceテーブルのstatusを更新する

        Rest::create([
            'attendance_id' => $request->attendance_id,
            'start_at' => Carbon::now(),
        ]);
        $workData= Attendance::find($request->attendance_id)->get();
        $workData->update(['status' => '休憩中']);
        return redirect()->route('attendance.show');
    }
    public function update(Request $request)
    {
        // 休憩戻りボタンを押したら、restレコードを更新する
        // user_id、attendance_idが一致、最新のレコードを検索し、end_atとattendanceテーブルのstatusのデータを更新する
        $rest=Rest::find($request->attendance_id)->get();
        $workData = Attendance::find($request->attendance_id)->get();
        if($rest->end_at==null) {
            $rest->update([
                'end_at' => Carbon::now(),
            ]);
            $workData->updated(['status' => '勤務中']);
        }
        
        return redirect()->route('attendance.show');
    }
}
