<?php

namespace Hotel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Hotel\Repositories\ContactPersonRepository;
use Hotel\Entities\ContactPerson;
use Hotel\Validators\ContactPersonValidator;

/**
 * Class ContactPersonRepositoryEloquent.
 *
 * @package namespace Hotel\Repositories;
 */
class ContactPersonRepositoryEloquent extends BaseRepository implements ContactPersonRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return ContactPerson::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return ContactPersonValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
