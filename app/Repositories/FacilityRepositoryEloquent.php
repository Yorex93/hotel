<?php

namespace Hotel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Hotel\Repositories\FacilityRepository;
use Hotel\Entities\Facility;
use Hotel\Validators\FacilityValidator;

/**
 * Class FacilityRepositoryEloquent.
 *
 * @package namespace Hotel\Repositories;
 */
class FacilityRepositoryEloquent extends BaseRepository implements FacilityRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Facility::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return FacilityValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
