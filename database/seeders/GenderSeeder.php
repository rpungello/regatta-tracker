<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    public function run(): void
    {
        foreach($this->getDefaultGenders() as $name => $color) {
            Gender::create([
                'name' => $name,
                'color' => $color
            ]);
        }
    }

    /**
     * @return string[]
     */
    private function getDefaultGenders(): array
    {
        return [
            'Male' => '6ca0dc',
            'Female' => 'f8b9d4'
        ];
    }
}
