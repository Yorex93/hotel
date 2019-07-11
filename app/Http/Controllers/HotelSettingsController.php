<?php

namespace Hotel\Http\Controllers;

use Illuminate\Http\Request;

use Hotel\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Hotel\Http\Requests\HotelSettingsCreateRequest;
use Hotel\Http\Requests\HotelSettingsUpdateRequest;
use Hotel\Repositories\HotelSettingsRepository;
use Hotel\Validators\HotelSettingsValidator;

/**
 * Class HotelSettingsController.
 *
 * @package namespace Hotel\Http\Controllers;
 */
class HotelSettingsController extends Controller
{
    /**
     * @var HotelSettingsRepository
     */
    protected $repository;

    /**
     * @var HotelSettingsValidator
     */
    protected $validator;

    /**
     * HotelSettingsController constructor.
     *
     * @param HotelSettingsRepository $repository
     * @param HotelSettingsValidator $validator
     */
    public function __construct(HotelSettingsRepository $repository, HotelSettingsValidator $validator)
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
        $hotelSettings = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $hotelSettings,
            ]);
        }

        return view('hotelSettings.index', compact('hotelSettings'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  HotelSettingsCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(HotelSettingsCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $hotelSetting = $this->repository->create($request->all());

            $response = [
                'message' => 'HotelSettings created.',
                'data'    => $hotelSetting->toArray(),
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
        $hotelSetting = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $hotelSetting,
            ]);
        }

        return view('hotelSettings.show', compact('hotelSetting'));
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
        $hotelSetting = $this->repository->find($id);

        return view('hotelSettings.edit', compact('hotelSetting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  HotelSettingsUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(HotelSettingsUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $hotelSetting = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'HotelSettings updated.',
                'data'    => $hotelSetting->toArray(),
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
                'message' => 'HotelSettings deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'HotelSettings deleted.');
    }
}
