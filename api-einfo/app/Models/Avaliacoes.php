<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Avaliacoes extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'evento_id',
        'resposta_1',
        'resposta_2',
        'resposta_3',
        'resposta_4',
        'resposta_5',
        'resposta_6',
        'resposta_7',
        'resposta_8',
        'resposta_9',
        'resposta_10'
    ];

    public function usuario()
    {  
        return $this->belongsTo('App\models\User');
    }
    public function evento()
    {  
        return $this->belongsTo('App\models\Evento');
    }
}
