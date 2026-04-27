<?php

namespace Database\Seeders;

use App\Models\TipoOperacaoLog;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TipoOperacaoLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $registers = [
            ['tipo' => 'get'],
            ['tipo' => 'store'],
            ['tipo' => 'update'],
            ['tipo' => 'delete']
        ];

        foreach ($registers as $register) {
            TipoOperacaoLog::create($register);
        };
    }
}
