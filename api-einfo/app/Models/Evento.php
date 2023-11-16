<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'nome',
        'descricao',
        'quantidade',
        'imagem',
        'local',
        'data',
        'horario'
    ];

    public function usuario()
    {  
        return $this->belongsTo('App\models\User');
    }

    public function inscricoes() 
    {
        return $this->hasMany('App\Models\Inscricoes');
    }

    public function avaliacoes() 
    {
        return $this->hasMany('App\Models\Avaliacoes');
    }
}
