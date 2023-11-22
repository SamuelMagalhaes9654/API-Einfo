<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::all();
    }

    public function store(Request $request)
    {
        User::create($request->all());
        return response()->json(['success' => 'Usuário cadastrado com sucess0'], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try{
            return User::findOrFail($id);
        }catch(\Exception $e){
            return response()->json(['erro' => 'id nao encontrado'], 404);
        }
        
    
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {   
        try{
            $usuario = User::findOrFail($id);
            $usuario->update($request->all());
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
            $usuario = User::findOrFail($id);
            $usuario->delete();
        }catch(\Exception $e){
            return response()->json(['erro' => 'id nao existe'], 404);
        }
        
    }
}


