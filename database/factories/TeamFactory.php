<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\TeamType;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class TeamFactory extends Factory
{
    protected $model = Team::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'name' => $this->faker->name(),
            'brand_color_primary' => $this->faker->safeHexColor(),
            'brand_color_secondary' => $this->faker->safeHexColor(),

            'team_type_id' => TeamType::factory(),
        ];
    }
}
