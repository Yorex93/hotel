<?php

namespace Hotel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Hotel\Repositories\PriceTypeRepository;
use Hotel\Entities\PriceType;
use Hotel\Validators\PriceTypeValidator;

/**
 * Class PriceTypeRepositoryEloquent.
 *
 * @package namespace Hotel\Repositories;
 */
class PriceTypeRepositoryEloquent extends BaseRepository implements PriceTypeRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return PriceType::class;
    }

    

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
