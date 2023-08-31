<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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
            'name' => 'Admin',
            'email' => 'superAdmin@gmail.com',
            'password' => bcrypt('cbk2023**'),
            'status' => false,
            'email_verified_at' => now()
        ])->assignRole('admin');

        \App\Models\User::factory(10)->create();
    }
}
