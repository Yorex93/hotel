<?php

namespace Hotel\Http\Api\Controllers;

use Hotel\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Hotel\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Hotel\Http\Requests\RoomTypeCreateRequest;
use Hotel\Http\Requests\RoomTypeUpdateRequest;
use Hotel\Repositories\RoomTypeRepository;
use Hotel\Validators\RoomTypeValidator;

/**
 * Class RoomTypesController.
 *
 * @package namespace Hotel\Http\Api\Controllers;
 */
class RoomTypesController extends Controller
{
    /**
     * @var RoomTypeRepository
     */
    protected $repository;

    /**
     * @var RoomTypeValidator
     */
    protected $validator;

    /**
     * RoomTypesController constructor.
     *
     * @param RoomTypeRepository $repository
     * @param RoomTypeValidator $validator
     */
    public function __construct(RoomTypeRepository $repository, RoomTypeValidator $validator)
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
        $roomTypes = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $roomTypes,
            ]);
        }

        return view('roomTypes.index', compact('roomTypes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RoomTypeCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(RoomTypeCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $roomType = $this->repository->create($request->all());

            $response = [
                'message' => 'RoomType created.',
                'data'    => $roomType->toArray(),
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
        $roomType = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $roomType,
            ]);
        }

        return view('roomTypes.show', compact('roomType'));
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
        $roomType = $this->repository->find($id);

        return view('roomTypes.edit', compact('roomType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  RoomTypeUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(RoomTypeUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $roomType = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'RoomType updated.',
                'data'    => $roomType->toArray(),
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
                'message' => 'RoomType deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'RoomType deleted.');
    }
}
