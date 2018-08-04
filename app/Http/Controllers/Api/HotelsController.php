<?php

namespace Hotel\Http\Api\Controllers;

use Hotel\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Hotel\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Hotel\Http\Requests\HotelCreateRequest;
use Hotel\Http\Requests\HotelUpdateRequest;
use Hotel\Repositories\HotelRepository;
use Hotel\Validators\HotelValidator;

/**
 * Class HotelsController.
 *
 * @package namespace Hotel\Http\Api\Controllers;
 */
class HotelsController extends Controller
{
    /**
     * @var HotelRepository
     */
    protected $repository;

    /**
     * @var HotelValidator
     */
    protected $validator;

    /**
     * HotelsController constructor.
     *
     * @param HotelRepository $repository
     * @param HotelValidator $validator
     */
    public function __construct(HotelRepository $repository, HotelValidator $validator)
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
        $hotels = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $hotels,
            ]);
        }

        return view('hotels.index', compact('hotels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  HotelCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(HotelCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $hotel = $this->repository->create($request->all());

            $response = [
                'message' => 'Hotel created.',
                'data'    => $hotel->toArray(),
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
        $hotel = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $hotel,
            ]);
        }

        return view('hotels.show', compact('hotel'));
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
        $hotel = $this->repository->find($id);

        return view('hotels.edit', compact('hotel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  HotelUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(HotelUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $hotel = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Hotel updated.',
                'data'    => $hotel->toArray(),
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
                'message' => 'Hotel deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Hotel deleted.');
    }
}
