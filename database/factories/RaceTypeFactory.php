<?php

namespace Database\Factories;

use App\Models\RaceType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class RaceTypeFactory extends Factory
{
    protected $model = RaceType::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'name' => $this->faker->unique()->word(),
        ];
    }
}
