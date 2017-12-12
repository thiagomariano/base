<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\DespesasImportadas;

/**
 * Class DespesasImportadasTransformer
 * @package namespace App\Transformers;
 */
class DespesasImportadasTransformer extends TransformerAbstract
{

    /**
     * Transform the DespesasImportadas entity
     * @param App\Entities\DespesasImportadas $model
     *
     * @return array
     */
    public function transform(DespesasImportadas $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
