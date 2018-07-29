<?php

namespace Hotel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Hotel\Repositories\DurationUnitRepository;
use Hotel\Entities\DurationUnit;
use Hotel\Validators\DurationUnitValidator;

/**
 * Class DurationUnitRepositoryEloquent.
 *
 * @package namespace Hotel\Repositories;
 */
class DurationUnitRepositoryEloquent extends BaseRepository implements DurationUnitRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return DurationUnit::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
