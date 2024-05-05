<?php

namespace Database\Factories;

use App\Models\TeamType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TeamTypeFactory extends Factory
{
    protected $model = TeamType::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'name' => $this->faker->name(),
        ];
    }
}
