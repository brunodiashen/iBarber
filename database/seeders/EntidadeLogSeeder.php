<?php

namespace Database\Seeders;

use App\Models\EntidadeLog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EntidadeLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registers = [
            ['entidade' => 'cliente'],
            ['entidade' => 'barbeiro'],
            ['entidade' => 'horario'],
            ['entidade' => 'endereco'],
            ['entidade' => 'auth']
        ];

        foreach ($registers as $register) {
            EntidadeLog::create($register);
        };
    }
}
