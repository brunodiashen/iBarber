<?php

namespace App\Http\Controllers;

use App\Models\Barbeiro;
use App\Models\Cliente;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class BarbeiroController extends Controller
{
    public function __construct(private Barbeiro $model) {}

    public function me() 
    {
        $user = auth('sanctum')->user()->id;

        return $this->model
            ->select('id', 'nome', 'email')
            ->where('user_id', $user)
            ->first();
    }

    public function index(Request $request)
    {
        $user = auth('sanctum')->user()->id;

        $cliente = Cliente::select('cidade')
            ->where('user_id', $user)
            ->join('enderecos', 'enderecos.id', 'endereco_id')
            ->first();

        if (is_null($cliente)) return [];

        return $this->model
            ->select('barbeiros.id', 'nome', 'cidade', 
                'bairro', 'rua', 'numero', 'cep',
                'horario_inicio', 'horario_fim', 'semAgenda', DB::raw('25 as espaco'))
            ->join('enderecos', 'endereco_id', 'enderecos.id')
            ->with('servicos')
            ->where('cidade', 'like', $request->cidade.'%')
            ->get();
    }

    public function cidades() {
        $user = auth('sanctum')->user()->id;

        return $this->model
            ->select('cidade')
            ->join('enderecos', 'endereco_id', 'enderecos.id')
            ->groupBy('cidade')
            ->get();
    }
}
