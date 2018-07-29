<?php

namespace Hotel\Http\Controllers;

use Illuminate\Http\Request;

use Hotel\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Hotel\Http\Requests\BookingCreateRequest;
use Hotel\Http\Requests\BookingUpdateRequest;
use Hotel\Repositories\BookingRepository;
use Hotel\Validators\BookingValidator;

/**
 * Class BookingsController.
 *
 * @package namespace Hotel\Http\Controllers;
 */
class BookingsController extends Controller
{
    /**
     * @var BookingRepository
     */
    protected $repository;

    /**
     * @var BookingValidator
     */
    protected $validator;

    /**
     * BookingsController constructor.
     *
     * @param BookingRepository $repository
     * @param BookingValidator $validator
     */
    public function __construct(BookingRepository $repository, BookingValidator $validator)
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
        $bookings = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $bookings,
            ]);
        }

        return view('bookings.index', compact('bookings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BookingCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(BookingCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $booking = $this->repository->create($request->all());

            $response = [
                'message' => 'Booking created.',
                'data'    => $booking->toArray(),
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
        $booking = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $booking,
            ]);
        }

        return view('bookings.show', compact('booking'));
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
        $booking = $this->repository->find($id);

        return view('bookings.edit', compact('booking'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BookingUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(BookingUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $booking = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Booking updated.',
                'data'    => $booking->toArray(),
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
                'message' => 'Booking deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Booking deleted.');
    }
}
