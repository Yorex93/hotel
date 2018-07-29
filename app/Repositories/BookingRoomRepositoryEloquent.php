<?php

namespace Hotel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Hotel\Repositories\BookingRoomRepository;
use Hotel\Entities\BookingRoom;
use Hotel\Validators\BookingRoomValidator;

/**
 * Class BookingRoomRepositoryEloquent.
 *
 * @package namespace Hotel\Repositories;
 */
class BookingRoomRepositoryEloquent extends BaseRepository implements BookingRoomRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return BookingRoom::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return BookingRoomValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
