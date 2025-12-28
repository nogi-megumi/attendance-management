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
    public function index(Request $request)
    {
        $user = Auth::user();
        $monthParam = $request->query('month', now()->format('Y-m'));
        $targetDate = Carbon::parse($monthParam . '-01');
        $startOfMonth = $targetDate->copy()->startOfMonth();
        $endOfMonth = $targetDate->copy()->endOfMonth();

        $workDatas = Attendance::query()
            ->where('user_id', $user->id)->whereBetween('start_at', [$startOfMonth, $endOfMonth])->with('rests')->orderBy('start_at', 'asc')
            ->get()->keyBy(function($item){
                return $item->start_at->format('Y-m-d');
            });

        $attendances=[];
        $tempDate=$startOfMonth->copy();
        while ($tempDate <= $endOfMonth) {
            $dateStr=$tempDate->format('Y-m-d');
            $workData=$workDatas->get($dateStr);
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

                $attendances[]=$workData;
            }else{
                $attendances[]=(object)[
                    'display_date'=>$tempDate->copy(),
                    'start_at'=>null,
                    'end_at'=>null,
                    'work_total'=>null,
                    'rest_total'=>null
                ];
            }
            $tempDate->addDay();
        }
        
        $data = [
            'targetDate' => $targetDate,
            'attendances' => $attendances,
        ];
        return view('attendance_index', $data);
    }

    public function show()
    {
        // 勤怠詳細を表示する
        return view('attendance_detail');
    }
}
