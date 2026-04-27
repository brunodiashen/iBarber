<?php

namespace Database\Seeders;

use App\Models\Pendente;
use App\Models\PendenteServico;
use Illuminate\Database\Seeder;

class PendenteSeeder extends Seeder
{
    public function generateRandomDate(): string {
        $startDate = strtotime('30-09-2025 00:10:00');
        $endDate = strtotime('30-12-2026 23:59:59');

        $randomDate = mt_rand($startDate, $endDate);

        return date('Y-m-d H:m:s', $randomDate);
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $one = [1];
        $two = [1,2];
        $servicos = [$one, $two];
        for ($i=0; $i < 100; $i++) { 
            $register = Pendente::create([
                'data' => $this->generateRandomDate(),
                'cliente_id' => random_int(2, 13),
                'barbeiro_id' => 1
            ]);

            $escolha = random_int(0, 1);
            foreach($servicos[$escolha] as $servico) {
                PendenteServico::create([
                    'servico_id' => $servico,
                    'pendente_id' => $register->id
                ]);
            }
        }
    }
}
