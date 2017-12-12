<?php

namespace App\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use App\Repositories\LimitesDespesasRepository;
use App\Entities\LimitesDespesas;
use App\Validators\LimitesDespesasValidator;

/**
 * Class LimitesDespesasRepositoryEloquent
 * @package namespace App\Repositories;
 */
class LimitesDespesasRepositoryEloquent extends BaseRepository implements LimitesDespesasRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return LimitesDespesas::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
}
