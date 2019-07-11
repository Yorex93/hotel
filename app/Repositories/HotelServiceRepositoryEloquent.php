<?php

namespace Hotel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Hotel\Repositories\HotelServiceRepository;
use Hotel\Entities\HotelService;
use Hotel\Validators\HotelServiceValidator;

/**
 * Class HotelServiceRepositoryEloquent.
 *
 * @package namespace Hotel\Repositories;
 */
class HotelServiceRepositoryEloquent extends BaseRepository implements HotelServiceRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return HotelService::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return HotelServiceValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
