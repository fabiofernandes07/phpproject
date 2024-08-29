<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModelClient extends Model
{
    protected $table='client';
    protected $fillable = [
        'nome',
        'data_nascimento',
        'cpf_cnpj',
        'foto',
        'nome_social',
    ];
    
    
}
