<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StampCorrectRequest extends Model
{
    use HasFactory;
    protected $fillable = [
        'attendance_id',
        'updated_start_at',
        'updated_end_at',
        'updated_rests',
        'note',
        'status',
    ];
    protected $casts = [
        'updated_start_at' => 'datetime',
        'updated_end_at' => 'datetime',
        'updated_rests'=>'array',
    ];
    public function attendance()
    {
        return $this->belongsTo(Attendance::class);
    }
}
