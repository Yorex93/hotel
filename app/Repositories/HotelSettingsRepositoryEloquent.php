<?php

namespace Hotel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Hotel\Repositories\HotelSettingsRepository;
use Hotel\Entities\HotelSettings;
use Hotel\Validators\HotelSettingsValidator;

/**
 * Class HotelSettingsRepositoryEloquent.
 *
 * @package namespace Hotel\Repositories;
 */
class HotelSettingsRepositoryEloquent extends BaseRepository implements HotelSettingsRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return HotelSettings::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return HotelSettingsValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
