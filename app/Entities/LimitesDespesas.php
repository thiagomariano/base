<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class LimitesDespesas extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'ano',
        'momento_planejamento',
        'ug',
        'descricao_regra',
        'valor_limite',
        'carater_despesa',
        'ptres',
        'natureza_despesa',
        'data_hora',
        'autor',
    ];
}
