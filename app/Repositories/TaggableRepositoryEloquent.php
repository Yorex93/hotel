<?php

namespace Hotel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Hotel\Repositories\TaggableRepository;
use Hotel\Entities\Taggable;
use Hotel\Validators\TaggableValidator;

/**
 * Class TaggableRepositoryEloquent.
 *
 * @package namespace Hotel\Repositories;
 */
class TaggableRepositoryEloquent extends BaseRepository implements TaggableRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Taggable::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
