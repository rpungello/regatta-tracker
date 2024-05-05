<?php

namespace Database\Factories;

use App\Models\Athlete;
use App\Models\Gender;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class AthleteFactory extends Factory
{
    protected $model = Athlete::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'name_first' => $this->faker->firstName(),
            'name_last' => $this->faker->lastName(),

            'team_id' => Team::factory(),
            'gender_id' => Gender::factory(),
        ];
    }
}
