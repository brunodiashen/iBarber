<?php

namespace App\Http\Controllers;

use App\Http\Requests\IntervaloRequest;
use App\Models\Barbeiro;
use App\Models\Intervalo;
use Illuminate\Http\Request;

class IntervaloController extends Controller
{
    public function __construct(private Intervalo $model) {}

    public function index()
    {
        $user = auth('sanctum')->user()->id;

        return $this->model->select('inicio', 'fim')
            ->where('user_id', $user)
            ->get();
    }

    public function barbearia(int $id)
    {
        $barbeiro = Barbeiro::select('user_id')
            ->where('id', $id)
            ->first();
        
        if ($barbeiro) {
            return $this->model->select('inicio', 'fim')
                ->where('user_id', $barbeiro->user_id)
                ->get();
        }
    }

    public function store(IntervaloRequest $request) 
    {
        $user = auth('sanctum')->user()->id;

        $barbeiro = Barbeiro::select('id', 'user_id')
            ->where('user_id', $request->user_id)
            ->first();
        
        if ($barbeiro && $barbeiro->user_id == $user) {
            Intervalo::create($request->all());
        }
    }
}
