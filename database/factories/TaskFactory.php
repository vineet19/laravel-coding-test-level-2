<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use Illuminate\Support\Str;

class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [                       
            'id' => Str::uuid(36),
            'title' => $this->faker->company(),
            'description' => $this->faker->text(),
            'user_id' => User::all()->random()->id,
        ];
    }
}
