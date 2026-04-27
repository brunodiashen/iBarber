<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Barbeiro;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class AuthenticatedSessionController extends Controller
{
    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        $user = $request->user();

        $user->tokens()->delete();

        $barbeiro = Barbeiro::select('id')
            ->where('user_id', $user->id)
            ->first();
        
        $token = '';

        if ($barbeiro) {
            $token = $user->createToken('user-token', 
                ['cliente', 'barbearia'])->plainTextToken;
        } else {
            $token = $user->createToken('user-token', 
                ['cliente'])->plainTextToken;
        }

        return [
            'dados' => $user,
            'token' => $token
        ];

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): Response
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return response()->noContent();
    }
}
