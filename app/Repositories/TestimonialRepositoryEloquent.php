<?php

namespace Hotel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Hotel\Repositories\TestimonialRepository;
use Hotel\Entities\Testimonial;
use Hotel\Validators\TestimonialValidator;

/**
 * Class TestimonialRepositoryEloquent.
 *
 * @package namespace Hotel\Repositories;
 */
class TestimonialRepositoryEloquent extends BaseRepository implements TestimonialRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Testimonial::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return TestimonialValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
