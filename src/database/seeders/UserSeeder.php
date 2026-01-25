<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'西怜奈',
            'email'=>'reina.n@coachtech.com',
            'password'=>Hash::make('testuser'),
        ]);
        User::factory()->count(5)->create();
    }
}
