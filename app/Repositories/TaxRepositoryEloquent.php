<?php

namespace Hotel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Hotel\Repositories\TaxRepository;
use Hotel\Entities\Tax;
use Hotel\Validators\TaxValidator;

/**
 * Class TaxRepositoryEloquent.
 *
 * @package namespace Hotel\Repositories;
 */
class TaxRepositoryEloquent extends BaseRepository implements TaxRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Tax::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return TaxValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
