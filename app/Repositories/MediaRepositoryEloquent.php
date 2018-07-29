<?php

namespace Hotel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Hotel\Repositories\MediaRepository;
use Hotel\Entities\Media;
use Hotel\Validators\MediaValidator;

/**
 * Class MediaRepositoryEloquent.
 *
 * @package namespace Hotel\Repositories;
 */
class MediaRepositoryEloquent extends BaseRepository implements MediaRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Media::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return MediaValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
