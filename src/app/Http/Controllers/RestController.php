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
        Rest::create([
            'attendance_id' => $request->attendance_id,
            'start_at' => Carbon::now(),
        ]);
        $workData = Attendance::find($request->attendance_id);
        $workData->update(['status' => 3]);
        return redirect()->route('attendance.show');
    }
    public function update(Request $request)
    {
        $rest = Rest::where('attendance_id',$request->attendance_id)
        ->whereNull('end_at')
        ->latest()
        ->first();
        $workData = Attendance::find($request->attendance_id);
        if ($rest) {
            $rest->update([
                'end_at' => Carbon::now(),
            ]);
            $workData->update(['status' => 2]);
        }
        return redirect()->route('attendance.show');
    }
}
