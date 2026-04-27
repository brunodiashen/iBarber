<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Endereco;
use Illuminate\Http\Request;

class EnderecoController extends Controller
{
    public function __construct(private Endereco $model) {}

    public function me()
    {
        $user = auth('sanctum')->user();

        return Endereco::select('estado', 'cidade', 'bairro', 'rua', 'numero', 'cep', 'telefone')
            ->join('clientes', 'endereco_id', 'enderecos.id')
            ->where('clientes.user_id', $user->id)
            ->first();
    }

    public function update(Request $request)
    {
        $user = auth('sanctum')->user();

        $cliente = Cliente::select('id','endereco_id','telefone')
            ->where('user_id', $user->id)
            ->first();

        $endereco = $this->model->find($cliente->endereco_id);
        
        $cliente->update(['telefone' => $request->telefone]);

        return $endereco->update($request->all());
    }
}
