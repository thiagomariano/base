<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Despesas;

/**
 * Class DespesasTransformer
 * @package namespace App\Transformers;
 */
class DespesasTransformer extends TransformerAbstract
{

    /**
     * @param Despesas $model
     * @return array
     */
    public function transform(Despesas $model)
    {
        return [
            'id'         => (int) $model->id,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
