<?php

namespace Hotel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Hotel\Repositories\BookingActivityRepository;
use Hotel\Entities\BookingActivity;
use Hotel\Validators\BookingActivityValidator;

/**
 * Class BookingActivityRepositoryEloquent.
 *
 * @package namespace Hotel\Repositories;
 */
class BookingActivityRepositoryEloquent extends BaseRepository implements BookingActivityRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BookingActivity::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return BookingActivityValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
