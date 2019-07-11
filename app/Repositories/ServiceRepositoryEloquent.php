<?php

namespace Hotel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Hotel\Repositories\ServiceRepository;
use Hotel\Entities\Service;
use Hotel\Validators\ServiceValidator;

/**
 * Class ServiceRepositoryEloquent.
 *
 * @package namespace Hotel\Repositories;
 */
class ServiceRepositoryEloquent extends BaseRepository implements ServiceRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Service::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ServiceValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
