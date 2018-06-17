<?php

namespace Hotel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Hotel\Repositories\HotelRepository;
use Hotel\Entities\Hotel;
use Hotel\Validators\HotelValidator;

/**
 * Class HotelRepositoryEloquent.
 *
 * @package namespace Hotel\Repositories;
 */
class HotelRepositoryEloquent extends BaseRepository implements HotelRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Hotel::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return HotelValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
