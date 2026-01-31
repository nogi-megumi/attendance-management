<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Attendance;
use App\Models\Rest;
use App\Models\StampCorrectRequest;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminSeeder::class);
        $fixedUser = User::create([
            'name' => '西怜奈',
            'email' => 'reina.n@coachtech.com',
            'password' => Hash::make('testuser'),
        ]);
        $this->call(UserSeeder::class);

        for ($i = 0; $i < 10; $i++) {
            $date = now()->subDays($i)->format('Y-m-d');

            $attendance = Attendance::create([
                'user_id' => $fixedUser->id,
                'start_at' => $date . '9:00:00',
                'end_at' => $date . '18:00:00',
                'status' => 4
            ]);
            if (rand(0, 1)) {
                Rest::factory()->create([
                    'attendance_id' => $attendance->id,
                ]);
            }
            if (rand(0, 1) === 0) {
                StampCorrectRequest::factory()->create([
                    'attendance_id' => $attendance->id,
                ]);
            }
        }
    }
}
