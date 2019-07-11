<?php

namespace Hotel\Http\Controllers\Api;

use Illuminate\Http\Request;
use Hotel\Http\Controllers\Controller;

use Hotel\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Hotel\Http\Requests\BookingRoomCreateRequest;
use Hotel\Http\Requests\BookingRoomUpdateRequest;
use Hotel\Repositories\BookingRoomRepository;
use Hotel\Validators\BookingRoomValidator;

/**
 * Class BookingRoomsController.
 *
 * @package namespace Hotel\Http\Controllers\Api;
 */
class BookingRoomsController extends Controller
{
    /**
     * @var BookingRoomRepository
     */
    protected $repository;

    /**
     * @var BookingRoomValidator
     */
    protected $validator;

    /**
     * BookingRoomsController constructor.
     *
     * @param BookingRoomRepository $repository
     * @param BookingRoomValidator $validator
     */
    public function __construct(BookingRoomRepository $repository, BookingRoomValidator $validator)
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
        $bookingRooms = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $bookingRooms,
            ]);
        }

        return view('bookingRooms.index', compact('bookingRooms'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BookingRoomCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(BookingRoomCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $bookingRoom = $this->repository->create($request->all());

            $response = [
                'message' => 'BookingRoom created.',
                'data'    => $bookingRoom->toArray(),
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
        $bookingRoom = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $bookingRoom,
            ]);
        }

        return view('bookingRooms.show', compact('bookingRoom'));
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
        $bookingRoom = $this->repository->find($id);

        return view('bookingRooms.edit', compact('bookingRoom'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BookingRoomUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(BookingRoomUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $bookingRoom = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'BookingRoom updated.',
                'data'    => $bookingRoom->toArray(),
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
                'message' => 'BookingRoom deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'BookingRoom deleted.');
    }
}
