<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sorteio extends Model
{
    public $table = 'sorteios';

    protected $fillable = [
        'titulo',
        'data_criacao',
        'data_sorteio',
        'opcoes',
        'sorteado',
    ];

    protected function casts(): array
    {
        return [
            'opcoes' => 'array'
        ];
    }
}
