<?php

namespace Hotel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Hotel\Repositories\ActivitySessionTimeRepository;
use Hotel\Entities\ActivitySessionTime;
use Hotel\Validators\ActivitySessionTimeValidator;

/**
 * Class ActivitySessionTimeRepositoryEloquent.
 *
 * @package namespace Hotel\Repositories;
 */
class ActivitySessionTimeRepositoryEloquent extends BaseRepository implements ActivitySessionTimeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ActivitySessionTime::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ActivitySessionTimeValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
