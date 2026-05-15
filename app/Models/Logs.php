<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    protected $fillable = [
        'mensagem','rota','codigo','erro','request',
        'tipo_operacao_log_id','entidade_log_id'
    ];

    public function tipoOperacao()
    {
        return $this->hasMany(TipoOperacaoLog::class);
    }

    public function entidade()
    {
        return $this->hasMany(EntidadeLog::class);
    }
}
