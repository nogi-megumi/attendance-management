<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\Attendance;
use Illuminate\Support\Facades\Auth;

class WorkController extends Controller
{
    public function show()
    {
        $today = Carbon::now();
        $user = Auth::user();
        $workData = Attendance::whereDate('created_at', $today)->where('user_id', $user->id)->first();
        if (!$workData) {
            $workStatus = 1;
        } else {
            $workStatus = $workData->status;
        }

        $data = [
            'today' => $today,
            'workStatus' => $workStatus,
            'workData' => $workData
        ];
        return view('time-stamp', $data);
    }

    public function store()
    {
        $user = Auth::user();
        Attendance::create([
            'user_id' => $user->id,
            'start_at' => Carbon::now(),
            'status' => 2
        ]);
        return redirect()->route('attendance.show');
    }
    public function update()
    {
        $user = Auth::user();
        $today = Carbon::today();
        $workData = Attendance::whereDate('created_at', $today)->where('user_id', $user->id)->first();
        if ($workData->status === 2) {
            $workData->update([
                'end_at' => Carbon::now(),
                'status' => 4
            ]);
        }
        return redirect()->route('attendance.show');
    }
}
