<?php

namespace Hotel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Hotel\Repositories\HasFacilityRepository;
use Hotel\Entities\HasFacility;
use Hotel\Validators\HasFacilityValidator;

/**
 * Class HasFacilityRepositoryEloquent.
 *
 * @package namespace Hotel\Repositories;
 */
class HasFacilityRepositoryEloquent extends BaseRepository implements HasFacilityRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return HasFacility::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
