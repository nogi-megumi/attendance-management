<?php

namespace App\Http\Controllers;

use App\Http\Requests\StampCorrectRequest;
use App\Models\Attendance;
use App\Models\StampCorrectRequest as ModelsStampCorrectRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StampCorrectRequestController extends Controller
{
    public function store(StampCorrectRequest $request){
        $rests=collect($request['rests'])->filter(function ($rest) {
            return !empty($rest['start_at']);
        })->values()->all();
        ModelsStampCorrectRequest::create([
            'attendance_id'=>$request->attendance_id,
            'updated_start_at'=>$request->updated_start_at,
            'updated_end_at'=>$request->updated_end_at,
            'updated_rests'=>$rests,
            'note'=>$request->note,
            'status'=>1, //1=承認待ち
        ]);
        return redirect()->back();
    }

    public function index(Request $request)
    {
        if (isset($request->tab)) {
            $tab = $request->get('tab');
        } else {
            $tab = 1;
        }
        // if (condition) {
        //     auth $gaurdがwebかadminか
        // }
        $user = Auth::user();
        $attendances = Attendance::where('user_id', $user->id)
            ->whereHas('stamp_correct_requests', function ($query) use ($tab) {
                $query->where('status', $tab);
            })
            ->with('stamp_correct_requests')
            ->orderBy('start_at', 'desc')
            ->get();
        return view('request_index', compact('attendances', 'tab'));
    }

    public function show($id){
        // 勤怠データを個別表示、修正内容を確認
        return view('admin_attendance_detail');
    }

    public function approve($id){
        // 管理者が修正内容を承認
        // attendanceとrestテーブルを更新する
        $request=StampCorrectRequest::find($id);
        $attendance=Attendance::find($request->attendance_id);

        $attendance->update([
            'start_at'=>$attendance->start_at->setTimeFromTimeString($request->updated_start_at),
            'end_at'=>$attendance->end_at->setTimeFromTimeString($request->updated_end_at),
        ]);

        $attendance->rests()->delete();
        foreach ($request->updated_rests as $restData) {
            $attendance->rests()->create([
                'start_at'=> $attendance->start_at->format('Y-m-d') . ' ' . $restData['start_at'],
                'end_at'=> $attendance->end_at->format('Y-m-d') . ' ' . $restData['end_at'],
            ]);
        }
        // リクエストのステータスを承認済みに変更
        $request->update(['status'=>2]); //2=承認済み
        return redirect()->back();
    }
}
