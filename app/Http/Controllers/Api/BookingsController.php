<?php

namespace Hotel\Http\Controllers\Api;

use Hotel\Services\Booking\BookingService;
use Hotel\Services\RoomType\RoomTypeService;
use Illuminate\Http\Request;
use Hotel\Http\Controllers\Controller;

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
 * @package namespace Hotel\Http\Controllers\Api;
 */
class BookingsController extends Controller
{
    /**
     * @var BookingService
     */
    protected $bookingService;

    /**
     * @var BookingValidator
     */
    protected $validator;

    protected $roomTypeService;

	/**
	 * BookingsController constructor.
	 *
	 * @param BookingService $booking_service
	 * @param BookingValidator $validator
	 * @param RoomTypeService $room_type_service
	 */
    public function __construct(BookingService $booking_service, BookingValidator $validator, RoomTypeService $room_type_service)
    {
        $this->bookingService = $booking_service;
        $this->validator  = $validator;
        $this->roomTypeService = $room_type_service;
    }


    public function checkAvailability(Request $request){
    	$this->validate($request, [
    		'checkIn' => 'required | numeric',
    		'checkOut' => 'required | numeric',
    		'adults' => 'required | integer',
    		'children' => 'required | integer',
	    ]);

	    $checkIn = $request->get('checkIn');
	    $checkOut = $request->get('checkOut');
	    $children = $request->get('children');
	    $adults = $request->get('adults');

    	$available = $this->roomTypeService->checkAvailability($checkIn, $checkOut, $adults, $children);
    	return response()->json(['data' => $available], 200);
    }

	public function makeReservation(Request $request){
		$this->validate($request, [
			'checkIn' => 'required | numeric',
			'checkOut' => 'required | numeric',
			'adults' => 'required | integer',
			'children' => 'required | integer',
			'firstName' => 'required',
			'lastName' => 'required',
			'phone' => 'required',
			'email' => 'required | email',
			'roomId' => 'required | exists:rooms,id',
			'paymentMethod' => 'required'
		]);

		try{
			$response = $this->bookingService->createBooking($request);
			return response()->json(['data' => $response], 200);
		} catch (\Throwable $e){
			return response()->json(['error' => $e->getMessage()], 500);
		}
	}


	public function confirmPayment(Request $request){
    	$this->validate($request, [
    		'reference' => 'required | exists:payments,payment_ref'
	    ]);

		try{
			$payment = $this->bookingService->checkPayment($request->get('reference'));
			return response()->json(['data' => $payment], 200);
		} catch (\Throwable $e){
			return response()->json(['data' => $e->getMessage()], 500);
		}
	}

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

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
