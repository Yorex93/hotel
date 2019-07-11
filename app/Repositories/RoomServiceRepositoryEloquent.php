<?php

namespace Hotel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Hotel\Repositories\RoomServiceRepository;
use Hotel\Entities\RoomService;
use Hotel\Validators\RoomServiceValidator;

/**
 * Class RoomServiceRepositoryEloquent.
 *
 * @package namespace Hotel\Repositories;
 */
class RoomServiceRepositoryEloquent extends BaseRepository implements RoomServiceRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return RoomService::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return RoomServiceValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
