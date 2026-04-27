<?php

namespace App\Http\Controllers;

use App\Http\Requests\AgendamentoRequest;
use App\Models\Agendamento;
use App\Models\Barbeiro;
use App\Models\Cliente;
use App\Models\Pendente;
use Illuminate\Http\Request;

class AgendamentoController extends Controller
{
    public function __construct(private Agendamento $model) {}

    public function cliente()
    {
        $user = auth('sanctum')->user()->id;

        $cliente = Cliente::select('id')
            ->where('user_id', $user)
            ->first();

        return is_null($cliente)
            ? [] 
            : $this->model->select('agendamentos.id','pendente_id','data','nome')
                ->join('pendentes', 'pendente_id', 'pendentes.id')
                ->join('barbeiros', 'barbeiro_id', 'barbeiros.id')
                ->where('cliente_id', $cliente->id)
                ->whereDate('data', '>=', date('Y-m-d'))
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
        
        return $this->model->select('agendamentos.id','pendente_id',
            'cliente_id','data','users.email','name','telefone')
            ->join('pendentes', 'pendente_id', 'pendentes.id')
            ->join('clientes', 'cliente_id', 'clientes.id')
            ->join('users', 'cliente_id', 'users.id')
            ->with('servicos')
            ->where('barbeiro_id', $barbearia->id)
            ->whereDate('data', '>=', date('Y-m-d'))
            ->orderBy('data')
            ->get();
    }

    public function store(AgendamentoRequest $request)
    {
        $user = auth('sanctum')->user()->id;

        $barbeiro = Barbeiro::select('id')
            ->where('user_id', $user)
            ->first();

        if ($barbeiro) {
            $horarios = $request->all();
            foreach ($horarios as $key => $horario) {
                if ($barbeiro->id == $horario['barbeiro_id']) {
                    $pendente = Pendente::select('id')
                        ->where('barbeiro_id', $horario['barbeiro_id'])
                        ->where('cliente_id', $horario['cliente_id'])
                        ->where('id', $horario['pendente_id'])
                        ->first();
                    
                    $existe = Agendamento::where('pendente_id', $pendente->id)
                        ->count();

                    if ($existe == 0) {
                        Agendamento::create(['pendente_id' => $pendente->id]);
                    }
                }
            }
        }
        return $barbeiro->id;
    }

    public function delete(AgendamentoRequest $request)
    {
        $user = auth('sanctum')->user()->id;

        $barbeiro = Barbeiro::select('id')
            ->where('user_id', $user)
            ->first();

        if ($barbeiro) {
            $horarios = $request->all();
            foreach ($horarios as $key => $horario) {
                if ($barbeiro->id == $horario['barbeiro_id']) {
                    $pendente = Pendente::select('id')
                        ->where('barbeiro_id', $horario['barbeiro_id'])
                        ->where('cliente_id', $horario['cliente_id'])
                        ->where('id', $horario['pendente_id'])
                        ->first();
                    
                    if ($pendente) {
                        Agendamento::where('pendente_id', $pendente->id)->delete();
                    }
                }
            }
        }
        return $barbeiro->id;
    }
}
