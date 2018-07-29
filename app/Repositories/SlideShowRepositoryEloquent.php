<?php

namespace Hotel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Hotel\Repositories\SlideShowRepository;
use Hotel\Entities\SlideShow;
use Hotel\Validators\SlideShowValidator;

/**
 * Class SlideShowRepositoryEloquent.
 *
 * @package namespace Hotel\Repositories;
 */
class SlideShowRepositoryEloquent extends BaseRepository implements SlideShowRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return SlideShow::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return SlideShowValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
