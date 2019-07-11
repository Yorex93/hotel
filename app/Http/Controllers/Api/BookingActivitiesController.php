<?php

namespace Hotel\Http\Controllers\Api;

use Illuminate\Http\Request;
use Hotel\Http\Controllers\Controller;

use Hotel\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Hotel\Http\Requests\BookingActivityCreateRequest;
use Hotel\Http\Requests\BookingActivityUpdateRequest;
use Hotel\Repositories\BookingActivityRepository;
use Hotel\Validators\BookingActivityValidator;

/**
 * Class BookingActivitiesController.
 *
 * @package namespace Hotel\Http\Controllers\Api;
 */
class BookingActivitiesController extends Controller
{
    /**
     * @var BookingActivityRepository
     */
    protected $repository;

    /**
     * @var BookingActivityValidator
     */
    protected $validator;

    /**
     * BookingActivitiesController constructor.
     *
     * @param BookingActivityRepository $repository
     * @param BookingActivityValidator $validator
     */
    public function __construct(BookingActivityRepository $repository, BookingActivityValidator $validator)
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
        $bookingActivities = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $bookingActivities,
            ]);
        }

        return view('bookingActivities.index', compact('bookingActivities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BookingActivityCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(BookingActivityCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $bookingActivity = $this->repository->create($request->all());

            $response = [
                'message' => 'BookingActivity created.',
                'data'    => $bookingActivity->toArray(),
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
        $bookingActivity = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $bookingActivity,
            ]);
        }

        return view('bookingActivities.show', compact('bookingActivity'));
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
        $bookingActivity = $this->repository->find($id);

        return view('bookingActivities.edit', compact('bookingActivity'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BookingActivityUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(BookingActivityUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $bookingActivity = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'BookingActivity updated.',
                'data'    => $bookingActivity->toArray(),
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
                'message' => 'BookingActivity deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'BookingActivity deleted.');
    }
}
