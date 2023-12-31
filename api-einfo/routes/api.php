<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\InscricoesController;
use App\Http\Controllers\AvaliacoesController;
use App\Http\Controllers\PresencaController;
use App\Models\Avaliacoes;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('api')->get('/user', function (Request $request) {
    return $request->user();
});
//Rotas para eventos
Route::get('evento', [EventoController::class, 'index']);
Route::apiResource('evento', EventoController::class)->middleware('auth')->except('index');
Route::get('meuseventos', [EventoController::class, 'meusEventos'])->middleware('auth');
Route::post('chat', [EventoController::class, 'chat']);

//rotas para usuario
Route::apiResource('usuario', UserController::class);

//Rotas para login de usuario
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth');
Route::post('refresh', [AuthController::class, 'refresh'])->middleware('auth');
Route::post('me', [AuthController::class, 'me'])->middleware('auth');

//rotas para inscricoes
Route::apiResource('inscricao', InscricoesController::class)->middleware('auth');
Route::get('eventosinscritos', [InscricoesController::class, 'minhasInscricoes'])->middleware('auth');
Route::get('verificarinscricao/{evento_id}', [InscricoesController::class, 'verificainscricao']);
Route::get('inscritos-evento/{evento_id}', [InscricoesController::class, 'inscritosEvento'])->middleware('auth');

//rotas para registrar inscrição
Route::post('registrar-presenca/{inscricao_id}', [PresencaController::class, 'registrarPresenca'])->middleware('auth');
//rotas para avaliacoes
Route::get('avaliacoes', [AvaliacoesController::class, 'index']);
Route::get('avaliar/{evento_id}', [AvaliacoesController::class, 'avaliar']);
Route::post('avaliacoes', [AvaliacoesController::class, 'store'])->middleware('auth');
//Route::apiResource('avaliacao', AvaliacoesController::class);

