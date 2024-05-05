<?php

namespace Database\Factories;

use App\Models\Entry;
use App\Models\Event;
use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class EntryFactory extends Factory
{
    protected $model = Entry::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'bow_number' => $this->faker->numberBetween(1, 9999),

            'event_id' => Event::factory(),
            'team_id' => Team::factory(),
        ];
    }
}
