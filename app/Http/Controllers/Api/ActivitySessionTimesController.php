<?php

namespace Hotel\Http\Api\Controllers;

use Illuminate\Http\Request;
use Hotel\Http\Controllers\Controller;

use Hotel\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Hotel\Http\Requests\ActivitySessionTimeCreateRequest;
use Hotel\Http\Requests\ActivitySessionTimeUpdateRequest;
use Hotel\Repositories\ActivitySessionTimeRepository;
use Hotel\Validators\ActivitySessionTimeValidator;

/**
 * Class ActivitySessionTimesController.
 *
 * @package namespace Hotel\Http\Api\Controllers;
 */
class ActivitySessionTimesController extends Controller
{
    /**
     * @var ActivitySessionTimeRepository
     */
    protected $repository;

    /**
     * @var ActivitySessionTimeValidator
     */
    protected $validator;

    /**
     * ActivitySessionTimesController constructor.
     *
     * @param ActivitySessionTimeRepository $repository
     * @param ActivitySessionTimeValidator $validator
     */
    public function __construct(ActivitySessionTimeRepository $repository, ActivitySessionTimeValidator $validator)
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
        $activitySessionTimes = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $activitySessionTimes,
            ]);
        }

        return view('activitySessionTimes.index', compact('activitySessionTimes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ActivitySessionTimeCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ActivitySessionTimeCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $activitySessionTime = $this->repository->create($request->all());

            $response = [
                'message' => 'ActivitySessionTime created.',
                'data'    => $activitySessionTime->toArray(),
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
        $activitySessionTime = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $activitySessionTime,
            ]);
        }

        return view('activitySessionTimes.show', compact('activitySessionTime'));
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
        $activitySessionTime = $this->repository->find($id);

        return view('activitySessionTimes.edit', compact('activitySessionTime'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ActivitySessionTimeUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ActivitySessionTimeUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $activitySessionTime = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'ActivitySessionTime updated.',
                'data'    => $activitySessionTime->toArray(),
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
                'message' => 'ActivitySessionTime deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'ActivitySessionTime deleted.');
    }
}
