<?php

namespace App\Http\Controllers;

use App\Models\Inscricoes;
use Illuminate\Http\Request;

class PresencaController extends Controller
{
    public function registrarPresenca( $inscricao_id)
    {
        $inscricao = Inscricoes::findOrFail($inscricao_id);
        $inscricao->update(['presente' => true]);

        return response()->json(['message' => 'Presença registrada com sucesso']);
    }
}
