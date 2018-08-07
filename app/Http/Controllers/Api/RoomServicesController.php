<?php

namespace Hotel\Http\Controllers\Api;

use Hotel\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Hotel\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Hotel\Http\Requests\RoomServiceCreateRequest;
use Hotel\Http\Requests\RoomServiceUpdateRequest;
use Hotel\Repositories\RoomServiceRepository;
use Hotel\Validators\RoomServiceValidator;

/**
 * Class RoomServicesController.
 *
 * @package namespace Hotel\Http\Controllers\Api;
 */
class RoomServicesController extends Controller
{
    /**
     * @var RoomServiceRepository
     */
    protected $repository;

    /**
     * @var RoomServiceValidator
     */
    protected $validator;

    /**
     * RoomServicesController constructor.
     *
     * @param RoomServiceRepository $repository
     * @param RoomServiceValidator $validator
     */
    public function __construct(RoomServiceRepository $repository, RoomServiceValidator $validator)
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
        $roomServices = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $roomServices,
            ]);
        }

        return view('roomServices.index', compact('roomServices'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RoomServiceCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(RoomServiceCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $roomService = $this->repository->create($request->all());

            $response = [
                'message' => 'RoomService created.',
                'data'    => $roomService->toArray(),
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
        $roomService = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $roomService,
            ]);
        }

        return view('roomServices.show', compact('roomService'));
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
        $roomService = $this->repository->find($id);

        return view('roomServices.edit', compact('roomService'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  RoomServiceUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(RoomServiceUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $roomService = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'RoomService updated.',
                'data'    => $roomService->toArray(),
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
                'message' => 'RoomService deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'RoomService deleted.');
    }
}
