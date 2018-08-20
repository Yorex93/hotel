<?php

namespace Hotel\Http\Controllers\Api;

use Hotel\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Hotel\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Hotel\Http\Requests\PageCreateRequest;
use Hotel\Http\Requests\PageUpdateRequest;
use Hotel\Repositories\PageRepository;
use Hotel\Validators\PageValidator;

/**
 * Class PagesController.
 *
 * @package namespace Hotel\Http\Controllers\Api;
 */
class PagesController extends Controller
{
    /**
     * @var PageRepository
     */
    protected $repository;

    /**
     * @var PageValidator
     */
    protected $validator;

    /**
     * PagesController constructor.
     *
     * @param PageRepository $repository
     * @param PageValidator $validator
     */
    public function __construct(PageRepository $repository, PageValidator $validator)
    {
        $this->repository = $repository;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pages = $this->repository->with('page_items')->all();
        return response()->json([
            'data' => $pages,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function store(Request $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $page = $this->repository->create($request->all());

            $response = [
                'message' => 'Page created.',
                'data'    => $page->toArray(),
            ];


            return response()->json($response);


        } catch (ValidatorException $e) {
            return response()->json([
                'error'   => true,
                'message' => $e->getMessageBag()
            ]);
        }
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  PageUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PageUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $page = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Page updated.',
                'data'    => $page->toArray(),
            ];

            return response()->json($response);

        } catch (ValidatorException $e) {

            return response()->json([
                'error'   => true,
                'message' => $e->getMessageBag()
            ]);

        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deleted = $this->repository->delete($id);
        return response()->json([
            'message' => 'Page deleted.',
            'deleted' => $deleted,
        ]);

    }
}
