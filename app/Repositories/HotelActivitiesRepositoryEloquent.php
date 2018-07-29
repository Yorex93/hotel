<?php

namespace Hotel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Hotel\Repositories\HotelActivitiesRepository;
use Hotel\Entities\HotelActivities;
use Hotel\Validators\HotelActivitiesValidator;

/**
 * Class HotelActivitiesRepositoryEloquent.
 *
 * @package namespace Hotel\Repositories;
 */
class HotelActivitiesRepositoryEloquent extends BaseRepository implements HotelActivitiesRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return HotelActivities::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
