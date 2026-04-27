<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Agendamento extends Model
{
    protected $fillable = ['pendente_id'];

    public function pendente()
    {
        return $this->belongsTo(Pendente::class);
    }

    public function servicos() 
    {
        return $this->hasMany(PendenteServico::class, 'pendente_id', 'pendente_id')
            ->join('servicos', 'servico_id', 'servicos.id');
    }
}
