<?php

namespace App\Http\Controllers;

use App\Http\Requests\PendenteRequest;
use App\Models\Agendamento;
use App\Models\Barbeiro;
use App\Models\Cliente;
use App\Models\Pendente;
use App\Models\PendenteServico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendenteController extends Controller
{
    public function __construct(private Pendente $model) {}

    public function me()
    {
        $user = auth('sanctum')->user()->id;

        $cliente = Cliente::select('id')
            ->where('user_id', $user)
            ->first();

        return is_null($cliente)
            ? [] 
            : $this->model->select('pendentes.id','data','nome','barbeiro_id')
                ->join('barbeiros', 'barbeiro_id', 'barbeiros.id')
                ->where('cliente_id', $cliente->id)
                ->whereDate('data', '>=', date('Y-m-d'))
                ->whereNotExists(function ($query) {
                    $query->select(DB::raw(1))
                          ->from('agendamentos')
                          ->whereColumn('pendentes.id', 'agendamentos.pendente_id');
                })
                ->get();
    }

    public function servicos(int $id)
    {
        $user = auth('sanctum')->user()->id;

        $cliente = Cliente::select('id')
            ->where('user_id', $user)
            ->first();

        return is_null($cliente)
            ? [] 
            : PendenteServico::select('pendente_servicos.id','tipo', 'pendente_id')
                ->join('servicos', 'servico_id', 'servicos.id')
                ->where('pendente_id', $id)
                ->get();
    }

    public function barbeiro()
    {
        $user = auth('sanctum')->user()->id;

        $barbearia = Barbeiro::select('id')
            ->where('user_id', $user)
            ->first();

        if (is_null($barbearia)) {
            return [];
        }
        
        return $this->model->select('pendentes.id','cliente_id',
            'barbeiro_id','data','users.email','name','telefone')
            ->join('clientes', 'cliente_id', 'clientes.id')
            ->join('users', 'user_id', 'users.id')
            ->with('servicos')
            ->where('barbeiro_id', $barbearia->id)
            ->whereDate('data', '>=', date('Y-m-d'))
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                        ->from('agendamentos')
                        ->whereColumn('pendentes.id', 'agendamentos.pendente_id');
            })
            ->orderBy('data')
            ->get();
    }
    
    public function store(PendenteRequest $request)
    { 
        $user = auth('sanctum')->user()->id;

        $cliente = Cliente::select('id')
            ->where('user_id', $user)
            ->first();

        if ($cliente && $cliente->id == $request->cliente_id) {
            $pendentes = $this->model
                ->select('pendentes.id')
                ->where('cliente_id', $cliente->id)
                ->whereDate('data', '>', date('Y-m-d H:m:s'))
                ->get();
            
            $jaPossuiAgendamento = Agendamento::whereIn('pendente_id', $pendentes)
                ->count();

            if ($jaPossuiAgendamento > 0) {
                return null;
            } else if ($pendentes->count() < 4) {
                $registro = Pendente::create([
                    'data' => $request->data ?? date('Y-m-d H:m:s'),
                    'barbeiro_id' => $request->barbeiro_id,
                    'cliente_id' => $request->cliente_id,
                ]);
                if ($request->servico_id) {
                    foreach($request->servico_id as $servico) {
                        PendenteServico::create([
                            'pendente_id' => $registro->id,
                            'servico_id' => $servico
                        ]);
                    }
                }
            }
        }
    }
}
