<?php

namespace Hotel\Http\Controllers\Api;

use Illuminate\Http\Request;
use Hotel\Http\Controllers\Controller;

use Hotel\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Hotel\Http\Requests\BookingServiceCreateRequest;
use Hotel\Http\Requests\BookingServiceUpdateRequest;
use Hotel\Repositories\BookingServiceRepository;
use Hotel\Validators\BookingServiceValidator;

/**
 * Class BookingServicesController.
 *
 * @package namespace Hotel\Http\Controllers\Api;
 */
class BookingServicesController extends Controller
{
    /**
     * @var BookingServiceRepository
     */
    protected $repository;

    /**
     * @var BookingServiceValidator
     */
    protected $validator;

    /**
     * BookingServicesController constructor.
     *
     * @param BookingServiceRepository $repository
     * @param BookingServiceValidator $validator
     */
    public function __construct(BookingServiceRepository $repository, BookingServiceValidator $validator)
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
        $bookingServices = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $bookingServices,
            ]);
        }

        return view('bookingServices.index', compact('bookingServices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  BookingServiceCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(BookingServiceCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $bookingService = $this->repository->create($request->all());

            $response = [
                'message' => 'BookingService created.',
                'data'    => $bookingService->toArray(),
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
        $bookingService = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $bookingService,
            ]);
        }

        return view('bookingServices.show', compact('bookingService'));
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
        $bookingService = $this->repository->find($id);

        return view('bookingServices.edit', compact('bookingService'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  BookingServiceUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(BookingServiceUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $bookingService = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'BookingService updated.',
                'data'    => $bookingService->toArray(),
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
                'message' => 'BookingService deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'BookingService deleted.');
    }
}
