<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Intervalo extends Model
{
    protected $fillable = ['inicio','fim','user_id'];

    public function usuario()
    {
        return $this->belongsTo(User::class);
    }
}
