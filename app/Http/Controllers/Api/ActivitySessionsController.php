<?php

namespace Hotel\Http\Api\Controllers;

use Illuminate\Http\Request;
use Hotel\Http\Controllers\Controller;

use Hotel\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Hotel\Http\Requests\ActivitySessionCreateRequest;
use Hotel\Http\Requests\ActivitySessionUpdateRequest;
use Hotel\Repositories\ActivitySessionRepository;
use Hotel\Validators\ActivitySessionValidator;

/**
 * Class ActivitySessionsController.
 *
 * @package namespace Hotel\Http\Api\Controllers;
 */
class ActivitySessionsController extends Controller
{
    /**
     * @var ActivitySessionRepository
     */
    protected $repository;

    /**
     * @var ActivitySessionValidator
     */
    protected $validator;

    /**
     * ActivitySessionsController constructor.
     *
     * @param ActivitySessionRepository $repository
     * @param ActivitySessionValidator $validator
     */
    public function __construct(ActivitySessionRepository $repository, ActivitySessionValidator $validator)
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
        $activitySessions = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $activitySessions,
            ]);
        }

        return view('activitySessions.index', compact('activitySessions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ActivitySessionCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ActivitySessionCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $activitySession = $this->repository->create($request->all());

            $response = [
                'message' => 'ActivitySession created.',
                'data'    => $activitySession->toArray(),
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
        $activitySession = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $activitySession,
            ]);
        }

        return view('activitySessions.show', compact('activitySession'));
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
        $activitySession = $this->repository->find($id);

        return view('activitySessions.edit', compact('activitySession'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ActivitySessionUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ActivitySessionUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $activitySession = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'ActivitySession updated.',
                'data'    => $activitySession->toArray(),
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
                'message' => 'ActivitySession deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'ActivitySession deleted.');
    }
}
