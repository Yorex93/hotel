<?php

namespace Hotel\Http\Controllers;

use Illuminate\Http\Request;

use Hotel\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Hotel\Http\Requests\ActivityCreateRequest;
use Hotel\Http\Requests\ActivityUpdateRequest;
use Hotel\Repositories\ActivityRepository;
use Hotel\Validators\ActivityValidator;

/**
 * Class ActivitiesController.
 *
 * @package namespace Hotel\Http\Controllers;
 */
class ActivitiesController extends Controller
{
    /**
     * @var ActivityRepository
     */
    protected $repository;

    /**
     * @var ActivityValidator
     */
    protected $validator;

    /**
     * ActivitiesController constructor.
     *
     * @param ActivityRepository $repository
     * @param ActivityValidator $validator
     */
    public function __construct(ActivityRepository $repository, ActivityValidator $validator)
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
        $activities = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $activities,
            ]);
        }

        return view('activities.index', compact('activities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ActivityCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ActivityCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $activity = $this->repository->create($request->all());

            $response = [
                'message' => 'Activity created.',
                'data'    => $activity->toArray(),
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
        $activity = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $activity,
            ]);
        }

        return view('activities.show', compact('activity'));
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
        $activity = $this->repository->find($id);

        return view('activities.edit', compact('activity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ActivityUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ActivityUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $activity = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Activity updated.',
                'data'    => $activity->toArray(),
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
                'message' => 'Activity deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Activity deleted.');
    }
}
