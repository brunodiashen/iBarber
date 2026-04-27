<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    protected $fillable = ['tipo','preco','duracao','barbeiro_id'];

    public function barbeiro()
    {
        return $this->belongsTo(Barbeiro::class);
    }
}
