<?php

namespace App\Http\Controllers;

use App\Http\Requests\StampCorrectRequest;
use App\Models\Attendance;
use App\Models\StampCorrectRequest as ModelsStampCorrectRequest;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class StampCorrectRequestController extends Controller
{
    public function store(StampCorrectRequest $request)
    {
        $rests = collect($request['rests'])->filter(function ($rest) {
            return !empty($rest['start_at']);
        })->values()->all();
        ModelsStampCorrectRequest::create([
            'attendance_id' => $request->attendance_id,
            'updated_start_at' => $request->updated_start_at,
            'updated_end_at' => $request->updated_end_at,
            'updated_rests' => $rests,
            'note' => $request->note,
            'status' => 1,
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
        $isAdmin = Auth::guard('admin')->check();
        if ($isAdmin) {
            $userIds = User::pluck('id');
        } else {
            $userIds = [Auth::id()];
        }
        $attendances = Attendance::whereIn('user_id', $userIds)
            ->whereHas('stamp_correct_requests', function ($query) use ($tab) {
                $query->where('status', $tab);
            })
            ->with(['stamp_correct_requests', 'user'])
            ->orderBy('start_at', 'desc')
            ->get();
        return view('request_index', compact('attendances', 'tab'));
    }

    public function show(ModelsStampCorrectRequest $correct_request)
    {
        $attendance = Attendance::find($correct_request->attendance_id)->first();
        $rests = $correct_request->updated_rests;
        $formatRests = array_map(function ($rest) {
            $rest['start_at'] = Carbon::parse($rest['start_at'])->format('H:i');
            $rest['end_at'] = Carbon::parse($rest['end_at'])->format('H:i');
            return $rest;
        }, $rests);
        $correct_request->updated_rests = $formatRests;
        return view('admin.request_detail', compact('attendance', 'correct_request'));
    }

    public function approve(Request $request, ModelsStampCorrectRequest $correct_request)
    {
        $attendance = Attendance::find($correct_request->attendance_id)->first();
        $attendance->update([
            'start_at' => $attendance->start_at->setTimeFromTimeString($request->updated_start_at),
            'end_at' => $attendance->end_at->setTimeFromTimeString($request->updated_end_at),
        ]);
        $attendance->rests()->delete();
        foreach ($request->updated_rests as $restData) {
            $attendance->rests()->create([
                'start_at' => $attendance->start_at->format('Y-m-d') . ' ' . $restData['start_at'],
                'end_at' => $attendance->end_at->format('Y-m-d') . ' ' . $restData['end_at'],
            ]);
        }
        $correct_request->update(['status' => 2]);
        return redirect()->back();
    }
}
