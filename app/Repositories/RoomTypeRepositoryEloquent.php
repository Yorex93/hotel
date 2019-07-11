<?php

namespace Hotel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Hotel\Repositories\RoomTypeRepository;
use Hotel\Entities\RoomType;
use Hotel\Validators\RoomTypeValidator;

/**
 * Class RoomTypeRepositoryEloquent.
 *
 * @package namespace Hotel\Repositories;
 */
class RoomTypeRepositoryEloquent extends BaseRepository implements RoomTypeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return RoomType::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return RoomTypeValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
