<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Imposto extends Model
{
    use HasFactory;

    protected $table = 'impostos';

    protected $fillable = [
        'sigla',
        'nome_completo',
        'icone',
        'descricao',
        'finalidade',
        'curiosidades',
    ];

    protected $casts = [
        'curiosidades' => 'string',
    ];
}
