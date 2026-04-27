<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PendenteServico extends Model
{
    protected $fillable = ['pendente_id','servico_id'];

    public function pendente()
    {
        return $this->belongsTo(Pendente::class);
    }

    public function servico()
    {
        return $this->belongsTo(Servico::class);
    }
}
