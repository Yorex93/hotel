<?php

namespace Hotel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Hotel\Repositories\HotelSocialRepository;
use Hotel\Entities\HotelSocial;
use Hotel\Validators\HotelSocialValidator;

/**
 * Class HotelSocialRepositoryEloquent.
 *
 * @package namespace Hotel\Repositories;
 */
class HotelSocialRepositoryEloquent extends BaseRepository implements HotelSocialRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return HotelSocial::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return HotelSocialValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
