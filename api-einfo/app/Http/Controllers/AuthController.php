<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $credenciais = $request->only(['email', 'password']);
        
        if(!$token = auth()->attempt($credenciais)){
            return response()->json(['erro' => 'Erro ao executar o login, verique seu email e senha'], 403);
        }

        return response()->json([
            'data' => [
                'token' => $token,
                'token_type' => 'Bearer',
                'expires_in' => auth()->factory()->getTTL()*60
            ]
            ]);
    }

     /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    
}
