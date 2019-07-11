<?php

namespace Hotel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Hotel\Repositories\PageItemRepository;
use Hotel\Entities\PageItem;
use Hotel\Validators\PageItemValidator;

/**
 * Class PageItemRepositoryEloquent.
 *
 * @package namespace Hotel\Repositories;
 */
class PageItemRepositoryEloquent extends BaseRepository implements PageItemRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PageItem::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return PageItemValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
