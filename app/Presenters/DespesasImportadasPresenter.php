<?php

namespace App\Presenters;

use App\Transformers\DespesasImportadasTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class DespesasImportadasPresenter
 *
 * @package namespace App\Presenters;
 */
class DespesasImportadasPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new DespesasImportadasTransformer();
    }
}
