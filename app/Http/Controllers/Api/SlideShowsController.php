<?php

namespace Hotel\Http\Api\Controllers;

use Illuminate\Http\Request;

use Hotel\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Hotel\Http\Requests\SlideShowCreateRequest;
use Hotel\Http\Requests\SlideShowUpdateRequest;
use Hotel\Repositories\SlideShowRepository;
use Hotel\Validators\SlideShowValidator;

/**
 * Class SlideShowsController.
 *
 * @package namespace Hotel\Http\Api\Controllers;
 */
class SlideShowsController extends Controller
{
    /**
     * @var SlideShowRepository
     */
    protected $repository;

    /**
     * @var SlideShowValidator
     */
    protected $validator;

    /**
     * SlideShowsController constructor.
     *
     * @param SlideShowRepository $repository
     * @param SlideShowValidator $validator
     */
    public function __construct(SlideShowRepository $repository, SlideShowValidator $validator)
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
        $slideShows = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $slideShows,
            ]);
        }

        return view('slideShows.index', compact('slideShows'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SlideShowCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(SlideShowCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $slideShow = $this->repository->create($request->all());

            $response = [
                'message' => 'SlideShow created.',
                'data'    => $slideShow->toArray(),
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
        $slideShow = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $slideShow,
            ]);
        }

        return view('slideShows.show', compact('slideShow'));
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
        $slideShow = $this->repository->find($id);

        return view('slideShows.edit', compact('slideShow'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SlideShowUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(SlideShowUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $slideShow = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'SlideShow updated.',
                'data'    => $slideShow->toArray(),
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
                'message' => 'SlideShow deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'SlideShow deleted.');
    }
}
