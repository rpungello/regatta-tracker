<?php

namespace Database\Factories;

use App\Models\Gender;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class GenderFactory extends Factory
{
    protected $model = Gender::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'name' => $this->faker->unique()->name(),
            'color' => $this->faker->unique()->safeHexColor(),
        ];
    }
}
