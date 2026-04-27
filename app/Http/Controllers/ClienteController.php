<?php

namespace App\Http\Controllers;

use App\Models\Barbeiro;
use App\Models\Cliente;
use App\Models\Endereco;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function __construct(private Cliente $model) {}

    public function me()
    {
        $user = auth('sanctum')->user()->id;

        $barbeiro = Barbeiro::select('id')
            ->where('user_id', $user)
            ->first();
        
        $cliente = $this->model
            ->select('id', 'nome', 'email')
            ->where('user_id', $user)
            ->first();
        
        if ($cliente && $barbeiro) {
            $cliente['barbeiro_id'] = $barbeiro->id;
        }

        return $cliente;
    }

    public function store(Request $request)
    {
        $endereco = null;
        try {
            $user = auth('sanctum')->user();

            if (is_null($user)) return null;

            $endereco = Endereco::create($request->all());

            if (is_null($endereco)) return null;

            $data = [
                'nome' => $user->name,
                'email' => $user->email,
                'endereco_id' => $endereco->id,
                'user_id' => $user->id,
                'telefone' => $request->telefone
            ];

            return $this->model->create($data);
        } catch (\Exception $e) {
            if (!is_null($endereco)) {
                Endereco::destroy($endereco->id);
            }
        }
    }
}
