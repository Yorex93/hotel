<?php

namespace Hotel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Hotel\Repositories\SocialRepository;
use Hotel\Entities\Social;
use Hotel\Validators\SocialValidator;

/**
 * Class SocialRepositoryEloquent.
 *
 * @package namespace Hotel\Repositories;
 */
class SocialRepositoryEloquent extends BaseRepository implements SocialRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Social::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
