<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StampCorrectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'updated_start_at'=>'required',
            'updated_end_at'=> 'required|after:updated_start_at',
            'rests.*.start_at'=> 'nullable|after:updated_start_at|before:updated_end_at',
            'rests.*.end_at' => 'nullable|after:rests.*.start_at|before:updated_end_at',
            'note'=> 'required',
        ];
    }
    public function messages()
    {
        return [
            'updated_end_at.after'=>'出勤時間もしくは退勤時間が不適切な値です',
            'rests.*.start_at.after'=>'休憩時間が不適切な値です',
            'rests.*.start_at.before'=> '休憩時間が不適切な値です',
            'rests.*.end_at.before' => '休憩時間もしくは退勤時間が不適切な値です',
            'note.required'=>'備考を記入してください',
        ];
    }
}
