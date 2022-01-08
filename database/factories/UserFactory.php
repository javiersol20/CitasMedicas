<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class  UserFactory extends Factory
{

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => bcrypt('admin123'), // password
            'remember_token' => Str::random(10),
            'dni' => $this->faker->unique->numberBetween(10000000000000, 99999999999999),
            'address' => $this->faker->address,
            'phone' => $this->faker->unique->e164PhoneNumber,
            'role' => $this->faker->randomElement(['patient', 'doctor']),
        ];
    }


    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
