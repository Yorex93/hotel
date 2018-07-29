<?php

namespace Hotel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Hotel\Repositories\TagRepository;
use Hotel\Entities\Tag;
use Hotel\Validators\TagValidator;

/**
 * Class TagRepositoryEloquent.
 *
 * @package namespace Hotel\Repositories;
 */
class TagRepositoryEloquent extends BaseRepository implements TagRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Tag::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return TagValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
