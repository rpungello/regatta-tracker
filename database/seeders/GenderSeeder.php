<?php

namespace Database\Seeders;

use App\Models\Gender;
use Illuminate\Database\Seeder;

class GenderSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->getDefaultGenders() as $name => $options) {
            Gender::create([
                'name' => $name,
                'color' => $options[0],
                'pluralize' => $options[1],
            ]);
        }
    }

    /**
     * @return string[]
     */
    private function getDefaultGenders(): array
    {
        return [
            'Men' => ['6ca0dc', true],
            'Women' => ['f8b9d4', true],
            'Non-binary' => ['fff430', false],
            'Mixed' => ['ffffff', false],
        ];
    }
}
