<?php

namespace App\Http\Controllers;

use App\Models\Servico;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    public function __construct(private Servico $model) {}

    public function barbeiro(int $id)
    {
        $user = auth('sanctum')->user()->id;

        return $this->model->select('id','tipo','preco','duracao')
            ->where('barbeiro_id', $id)
            ->get();
    }
}
