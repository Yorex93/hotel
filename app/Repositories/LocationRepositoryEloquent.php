<?php

namespace Hotel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Hotel\Repositories\LocationRepository;
use Hotel\Entities\Location;
use Hotel\Validators\LocationValidator;

/**
 * Class LocationRepositoryEloquent.
 *
 * @package namespace Hotel\Repositories;
 */
class LocationRepositoryEloquent extends BaseRepository implements LocationRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Location::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return LocationValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
