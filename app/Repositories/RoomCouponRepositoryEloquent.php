<?php

namespace Hotel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Hotel\Repositories\RoomCouponRepository;
use Hotel\Entities\RoomCoupon;
use Hotel\Validators\RoomCouponValidator;

/**
 * Class RoomCouponRepositoryEloquent.
 *
 * @package namespace Hotel\Repositories;
 */
class RoomCouponRepositoryEloquent extends BaseRepository implements RoomCouponRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return RoomCoupon::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return RoomCouponValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
