<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class RegrasGerais extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'ano',
        'momento_planejamento',
        'descricao_regra',
        'percentual_ajuste',
        'carater_despesa',
        'ptres',
        'natureza_despesa',
        'data_hora',
        'autor',
    ];

}
