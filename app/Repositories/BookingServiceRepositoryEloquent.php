<?php

namespace Hotel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Hotel\Repositories\BookingServiceRepository;
use Hotel\Entities\BookingService;
use Hotel\Validators\BookingServiceValidator;

/**
 * Class BookingServiceRepositoryEloquent.
 *
 * @package namespace Hotel\Repositories;
 */
class BookingServiceRepositoryEloquent extends BaseRepository implements BookingServiceRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BookingService::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return BookingServiceValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
