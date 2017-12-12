<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Importacoes;

/**
 * Class ImportacoesTransformer
 * @package namespace App\Transformers;
 */
class ImportacoesTransformer extends TransformerAbstract
{

    /**
     * @param Importacoes $model
     * @return array
     */
    public function transform(Importacoes $model)
    {
        return [
            'codigo' => $model->id,
            'descricao' => $model->descricao,
            'autor' => $model->autor,
            'ano' => $model->ano,
            'qtdItens' => $model->quantidade_itens,
        ];
    }
}
