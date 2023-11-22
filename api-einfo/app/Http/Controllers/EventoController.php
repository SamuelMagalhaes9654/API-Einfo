<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEventoRequest;
use App\Http\Requests\UpdateEventoRequest;
use App\Models\Evento;
use App\Models\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class EventoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if($request->has('nome')){
            $nome = $request->nome;
            return Evento::where('nome', 'like', '%'.$nome.'%')->get();
        } else{
            return Evento::all();
        }
        
    }

    public function store(StoreEventoRequest $request)
    {
        $user_id = auth()->user()->id;

        $imagem = $request->file('imagem');
        $nome_imagem = $imagem->store('imagens','public');

        //$request->validate();
        Evento::create([
            'user_id'=>$user_id,
            'nome'=> $request->nome,
            'descricao'=> $request->descricao,
            'quantidade'=> $request ->quantidade,
            'imagem'=> $nome_imagem,
            'local'=> $request->local,
            'data'=> $request->data,
            'horario'=>  $request->horario
        ]);
        return response()->json(['success' => 'Evento criado com sucesso'], 201);
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
        $user_id = auth()->user()->id;
        if($request->has('imagem')){
            $imagem = $request->file('imagem');
            $nome_imagem = $imagem->store('imagens','public');

            try{
                $evento = Evento::findOrFail($id);
                Storage::disk('public')->delete($evento->imagem);
                $evento->update(['imagem' => $nome_imagem]);
            }catch(\Exception $e){
                return response()->json(['erro' => 'deu um erro ai'], 404);
            }
            
        }

        try{
            $evento = Evento::findOrFail($id);
            $evento->update($request->all());
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
            Storage::disk('public')->delete($evento->imagem);
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
