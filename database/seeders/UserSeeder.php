<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

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
            'name' => "Javier Solis",
            'email' => "javsolis908@gmail.com",
            'email_verified_at' => now(),
            'password' => bcrypt('admin1234'), // password
            'remember_token' => Str::random(10),
            'dni' => "3234507091001",
            'address' => "Colonia vista hermosa zona 0, mazatenango, such",
            'phone' => "+50230289927",
            'role' => "admin"
        ]);
        //User::factory(50)->create();
    }
}
