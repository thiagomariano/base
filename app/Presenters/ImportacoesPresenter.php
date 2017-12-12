<?php

namespace App\Presenters;

use App\Transformers\ImportacoesTransformer;
use Prettus\Repository\Presenter\FractalPresenter;

/**
 * Class ImportacoesPresenter
 *
 * @package namespace App\Presenters;
 */
class ImportacoesPresenter extends FractalPresenter
{
    /**
     * Transformer
     *
     * @return \League\Fractal\TransformerAbstract
     */
    public function getTransformer()
    {
        return new ImportacoesTransformer();
    }
}
