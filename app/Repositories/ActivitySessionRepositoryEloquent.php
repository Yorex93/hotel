<?php

namespace Hotel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Hotel\Repositories\ActivitySessionRepository;
use Hotel\Entities\ActivitySession;
use Hotel\Validators\ActivitySessionValidator;

/**
 * Class ActivitySessionRepositoryEloquent.
 *
 * @package namespace Hotel\Repositories;
 */
class ActivitySessionRepositoryEloquent extends BaseRepository implements ActivitySessionRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ActivitySession::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ActivitySessionValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
