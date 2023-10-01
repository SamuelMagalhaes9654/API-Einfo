<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventoRequest;
use App\Http\Requests\UpdateEventoRequest;
use App\Models\Evento;
use App\Models\User;
use Illuminate\Http\Request;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Evento::all();
    }

    public function store(StoreEventoRequest $request)
    {
        $user_id = auth()->user()->id;
        //$request->validate();
        Evento::create([
            'user_id'=>$user_id,
            'nome'=> $request->nome,
            'descricao'=> $request->descricao,
            'quantidade'=> $request ->quantidade,
            'imagem'=> 'imagem teste por enquanto',//$request->imagem
            'local'=> $request->local,
            'data'=> $request->data,
            'horario'=>  $request->horario
        ]);
        return "Evento criado com sucesso";
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try{
            return Evento::findOrFail($id);
        }catch(\Exception $e){
            return response()->json(['erro' => 'id nao encontrado'], 404);
        }
        
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEventoRequest $request, $id)
    {   
        try{
            $evento = Evento::findOrFail($id);
            $evento->update($request->validated());
        }catch(\Exception $e){
            return response()->json(['erro' => 'id nao existe'], 404);
        }
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {   
        try{
            $evento = Evento::findOrFail($id);
            $evento->delete();
        }catch(\Exception $e){
            return response()->json(['erro' => 'id nao existe'],404);
        }
        
    }

    /**
     * Gets resources from authenticated user
     */
    public function meusEventos()
    {   
        $user_id = auth()->user()->id;
        return Evento::where('user_id', 'like', $user_id)->get();
        
    }
}
