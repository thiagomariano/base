<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\RegrasGeraisRepository;
use App\Entities\RegrasGerais;
use App\Validators\RegrasGeraisValidator;

/**
 * Class RegrasGeraisRepositoryEloquent
 * @package namespace App\Repositories;
 */
class RegrasGeraisRepositoryEloquent extends BaseRepository implements RegrasGeraisRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return RegrasGerais::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return RegrasGeraisValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
