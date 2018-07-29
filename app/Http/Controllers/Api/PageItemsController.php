<?php

namespace Hotel\Http\Api\Controllers;

use Illuminate\Http\Request;

use Hotel\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Hotel\Http\Requests\PageItemCreateRequest;
use Hotel\Http\Requests\PageItemUpdateRequest;
use Hotel\Repositories\PageItemRepository;
use Hotel\Validators\PageItemValidator;

/**
 * Class PageItemsController.
 *
 * @package namespace Hotel\Http\Api\Controllers;
 */
class PageItemsController extends Controller
{
    /**
     * @var PageItemRepository
     */
    protected $repository;

    /**
     * @var PageItemValidator
     */
    protected $validator;

    /**
     * PageItemsController constructor.
     *
     * @param PageItemRepository $repository
     * @param PageItemValidator $validator
     */
    public function __construct(PageItemRepository $repository, PageItemValidator $validator)
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
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $pageItems = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $pageItems,
            ]);
        }

        return view('pageItems.index', compact('pageItems'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PageItemCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(PageItemCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $pageItem = $this->repository->create($request->all());

            $response = [
                'message' => 'PageItem created.',
                'data'    => $pageItem->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pageItem = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $pageItem,
            ]);
        }

        return view('pageItems.show', compact('pageItem'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $pageItem = $this->repository->find($id);

        return view('pageItems.edit', compact('pageItem'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PageItemUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PageItemUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $pageItem = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'PageItem updated.',
                'data'    => $pageItem->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ]);
            }

            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
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

        if (request()->wantsJson()) {

            return response()->json([
                'message' => 'PageItem deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'PageItem deleted.');
    }
}
