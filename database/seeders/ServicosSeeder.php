<?php

namespace Database\Seeders;

use App\Models\Servico;
use Random\Randomizer;
use Illuminate\Database\Seeder;

class ServicosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $randomizer = new Randomizer();
        $registers = [
            ['tipo' => 'Cortar Cabelo',
                'duracao' => '00:30',
                'preco' => '20.00',
                'barbeiro_id' => 1],
            ['tipo' => 'Fazer barba',
                'duracao' => '00:30',
                'preco' => '30.00',
                'barbeiro_id' => 1],
        ];
        for ($i=1; $i < 13; $i++) { 
            foreach ($registers as $register) {
                $register['barbeiro_id'] = $i;
                $register['preco'] = sprintf("%.2f", $randomizer->getFloat(10.0,50.0));
                Servico::create($register);
            };
        }
    }
}
