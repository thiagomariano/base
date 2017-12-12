<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Importacoes extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'id',
        'descricao',
        'ano',
        'autor',
        'quantidade_itens'
    ];

}
