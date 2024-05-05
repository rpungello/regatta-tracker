<?php

namespace Database\Factories;

use App\Models\BoatClass;
use App\Models\Event;
use App\Models\EventClass;
use App\Models\Gender;
use App\Models\Regatta;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class EventFactory extends Factory
{
    protected $model = Event::class;

    public function definition(): array
    {
        return [
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'name' => $this->faker->unique()->name(),
            'code' => $this->faker->optional()->unique()->bothify('##?#'),

            'regatta_id' => Regatta::factory(),
            'gender_id' => Gender::factory(),
            'event_class_id' => EventClass::factory(),
            'boat_class_id' => BoatClass::factory(),
        ];
    }
}
