<?php

namespace App\Http\Controllers;

use App\Models\Inscricoes;
use App\Http\Requests\StoreInscricoesRequest;
use App\Http\Requests\UpdateInscricoesRequest;
use Illuminate\Support\Facades\DB;

class InscricoesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Inscricoes::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInscricoesRequest $request)
    {
        $user_id = auth()->user()->id;
        Inscricoes::create([
            'user_id'=> $user_id,
            'evento_id'=> $request->evento_id
        ]);

        return response()->json(['status' => 'Inscrição realizada com sucesso'], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try{
            return Inscricoes::findOrFail($id);
        }catch(\Exception $e){
            return response()->json(['erro' => 'id nao encontrado'], 404);
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        try{
            $inscricao = Inscricoes::findOrFail($id);
            $inscricao->delete();
        }catch(\Exception $e){
            return response()->json(['erro' => 'id nao existe'],404);
        }
    }

    public function minhasInscricoes()
    {
        $user_id = auth()->user()->id;
        return Inscricoes::where('user_id', '=', $user_id)->get();
    }

    public function verificainscricao($id, $id_usuario)
    {
        $user_id = auth()->user()->id;
        $inscricao = Inscricoes::where('user_id', '=', $id_usuario)->where('evento_id','=', $id)->first();

        if ($inscricao) {
            // O usuário está inscrito no evento
            return response()->json(['inscrito' => true]);
        } else {
            // O usuário não está inscrito no evento
            return response()->json(['inscrito' => false]);
        }
    }

    public function inscritosEvento($evento_id)
    {
        $inscritos = Inscricoes::select('inscricoes.*','users.name', 'users.email', 'users.descriptor')->where('evento_id', $evento_id)->join('users', 'inscricoes.user_id', '=', 'users.id')->get();
        return $inscritos;
    }
}
