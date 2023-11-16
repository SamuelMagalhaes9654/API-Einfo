<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Inscricoes extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'evento_id',
        'presente'
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
