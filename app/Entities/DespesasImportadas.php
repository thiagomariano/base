<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class DespesasImportadas extends Model implements Transformable
{
    use TransformableTrait;

    protected $fillable = [
        'descricao',
        'ano',
        'opcao_reflexo_ano',
        'unidade_gestora',
        'responsavel',
        'esfera',
        'ptres',
        'unidade_orcamentaria',
        'natureza_despesa',
        'carater_despesa',
        'fonte',
        'categoria',
        'vinculacao',
        'tipo_recurso',
        'tipo_orcamento',
        'perspectiva',
        'macrodesafio',
        'objetivo',
        'programa',
        'tipo_operacional',
        'numero_contrato',
        'nome_empresa_contratada',
        'cpf_cnpj_contratada',
        'inicio_vigencia',
        'termino_vigencia',
        'valor_contrato',
        'dotacao_autorizada_exercicio_anterior',
        'dase_exercicio_anterior',
        'reajuste',
        'reajuste_aplicado',
        'base_exercicio_atual',
        'proposta_inicial',
        'solicitado_pelo_responsavel',
        'ajuste_setorial_pre_proposta',
        'proposta_ajustada_limite',
        'orcamento_aprovado',
        'valor_mensal_maximo_autorizado',
        'idImportacao'
    ];

}
