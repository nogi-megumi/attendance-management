<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;

class AdminAttendanceController extends Controller
{
    public function index(Request $request)
    {
        // 日付毎の勤怠一覧表を表示
        $dayParam = $request->query('day', now()->toDateString());
        try {
            $targetDate = Carbon::parse($dayParam);
        } catch (\Exception $e) {
            $targetDate =now();
        }

        $users=User::with(['attendances'=>function($query) use ($targetDate){
            $query->whereDate('start_at', $targetDate->toDateString());
        },'attendances.rests'])->get();

        $attendances = [];
        foreach($users as $user){
            $workData=$user->attendances->first();

            if ($workData) {
                $totalRestMinutes = 0;
                foreach ($workData->rests as $rest) {
                    if ($rest->start_at && $rest->end_at) {
                        $totalRestMinutes += $rest->start_at->diffInMinutes($rest->end_at);
                    }
                }

                $stayMinutes = 0;
                if ($workData->end_at) {
                    $stayMinutes = $workData->start_at->diffInMinutes($workData->end_at);
                }
                $workingMinutes = max(0, $stayMinutes - $totalRestMinutes);

                $workData->work_total = sprintf('%02d:%02d', floor($workingMinutes / 60), $workingMinutes % 60);
                $workData->rest_total = sprintf('%02d:%02d', floor($totalRestMinutes / 60), $totalRestMinutes % 60);

                $attendances[] = $workData;
            } else {
                $attendances[] = (object)[
                    'user'=>$user,
                    'start_at' => null,
                    'end_at' => null,
                    'work_total' => null,
                    'rest_total' => null
                ];
            }
        }
        
        return view('admin.attendance_index',compact('attendances','targetDate'));
    }
}
