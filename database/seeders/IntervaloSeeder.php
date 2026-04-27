<?php

namespace Database\Seeders;

use App\Models\Intervalo;
use Illuminate\Database\Seeder;

class IntervaloSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registers = [
            ['inicio' => '11:00',
                'fim' => '12:30',
                'user_id' => 2],
            ['inicio' => '15:00',
                'fim' => '16:30',
                'user_id' => 2],
            ['inicio' => '11:00',
                'fim' => '12:30',
                'user_id' => 3],
            ['inicio' => '15:00',
                'fim' => '16:30',
                'user_id' => 3],
        ];

        foreach ($registers as $register) {
            Intervalo::create($register);
        };
    }
}
