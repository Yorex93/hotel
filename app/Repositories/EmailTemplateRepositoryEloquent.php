<?php

namespace Hotel\Repositories;

use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use Hotel\Repositories\EmailTemplateRepository;
use Hotel\Entities\EmailTemplate;
use Hotel\Validators\EmailTemplateValidator;

/**
 * Class EmailTemplateRepositoryEloquent.
 *
 * @package namespace Hotel\Repositories;
 */
class EmailTemplateRepositoryEloquent extends BaseRepository implements EmailTemplateRepository
{
    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return EmailTemplate::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return EmailTemplateValidator::class;
    }


    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }
    
}
