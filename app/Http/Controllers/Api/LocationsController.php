<?php

namespace Hotel\Http\Api\Controllers;

use Illuminate\Http\Request;

use Hotel\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Hotel\Http\Requests\LocationCreateRequest;
use Hotel\Http\Requests\LocationUpdateRequest;
use Hotel\Repositories\LocationRepository;
use Hotel\Validators\LocationValidator;

/**
 * Class LocationsController.
 *
 * @package namespace Hotel\Http\Api\Controllers;
 */
class LocationsController extends Controller
{
    /**
     * @var LocationRepository
     */
    protected $repository;

    /**
     * @var LocationValidator
     */
    protected $validator;

    /**
     * LocationsController constructor.
     *
     * @param LocationRepository $repository
     * @param LocationValidator $validator
     */
    public function __construct(LocationRepository $repository, LocationValidator $validator)
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
        $locations = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $locations,
            ]);
        }

        return view('locations.index', compact('locations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  LocationCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(LocationCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $location = $this->repository->create($request->all());

            $response = [
                'message' => 'Location created.',
                'data'    => $location->toArray(),
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
        $location = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $location,
            ]);
        }

        return view('locations.show', compact('location'));
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
        $location = $this->repository->find($id);

        return view('locations.edit', compact('location'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  LocationUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(LocationUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $location = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Location updated.',
                'data'    => $location->toArray(),
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
                'message' => 'Location deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Location deleted.');
    }
}
