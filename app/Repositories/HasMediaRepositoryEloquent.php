<?php

namespace Hotel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Hotel\Repositories\HasMediaRepository;
use Hotel\Entities\HasMedia;
use Hotel\Validators\HasMediaValidator;

/**
 * Class HasMediaRepositoryEloquent.
 *
 * @package namespace Hotel\Repositories;
 */
class HasMediaRepositoryEloquent extends BaseRepository implements HasMediaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return HasMedia::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
