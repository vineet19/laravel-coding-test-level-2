<?php

namespace Database\Factories;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
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
            'name' => $this->faker->company(),
        ];
    }
}
