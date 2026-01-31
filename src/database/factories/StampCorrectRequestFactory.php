<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class StampCorrectRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'updated_start_at' => '9:00:00',
            'updated_end_at' => '18:00:00',
            'updated_rests'=>json_encode(['id' => null,'start_at' => '12:00:00', 'end_at' => '13:00:00']),
            'note'=>'電車遅延のため',
            'status'=>1
        ];
    }
}
