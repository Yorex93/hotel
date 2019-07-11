<?php

namespace Hotel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Hotel\Repositories\ReviewableRepository;
use Hotel\Entities\Reviewable;
use Hotel\Validators\ReviewableValidator;

/**
 * Class ReviewableRepositoryEloquent.
 *
 * @package namespace Hotel\Repositories;
 */
class ReviewableRepositoryEloquent extends BaseRepository implements ReviewableRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Reviewable::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
