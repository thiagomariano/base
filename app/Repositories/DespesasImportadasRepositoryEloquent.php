<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\DespesasImportadasRepository;
use App\Entities\DespesasImportadas;
use App\Validators\DespesasImportadasValidator;

/**
 * Class DespesasImportadasRepositoryEloquent
 * @package namespace App\Repositories;
 */
class DespesasImportadasRepositoryEloquent extends BaseRepository implements DespesasImportadasRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return DespesasImportadas::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return DespesasImportadasValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
