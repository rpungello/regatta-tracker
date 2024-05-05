<?php

namespace Database\Seeders;

use App\Models\BoatClass;
use Illuminate\Database\Seeder;

class BoatClassSeeder extends Seeder
{
    public function run(): void
    {
        foreach ($this->getDefaultBoatClasses() as $name => $code) {
            BoatClass::create([
                'name' => $name,
                'code' => $code,
            ]);
        }
    }

    /**
     * @return array<string, string>
     */
    private function getDefaultBoatClasses(): array
    {
        return [
            'Single' => '1x',
            'Double' => '2x',
            'Quad' => '4x',
            'Coxed Quad' => '4x+',
            'Octuple' => '8x',
            'Pair' => '2-',
            'Straight Four' => '4-',
            'Coxed Four' => '4+',
            'Eight' => '8+',
        ];
    }
}
