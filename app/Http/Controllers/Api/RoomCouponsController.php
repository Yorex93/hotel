<?php

namespace Hotel\Http\Api\Controllers;

use Illuminate\Http\Request;

use Hotel\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Hotel\Http\Requests\RoomCouponCreateRequest;
use Hotel\Http\Requests\RoomCouponUpdateRequest;
use Hotel\Repositories\RoomCouponRepository;
use Hotel\Validators\RoomCouponValidator;

/**
 * Class RoomCouponsController.
 *
 * @package namespace Hotel\Http\Api\Controllers;
 */
class RoomCouponsController extends Controller
{
    /**
     * @var RoomCouponRepository
     */
    protected $repository;

    /**
     * @var RoomCouponValidator
     */
    protected $validator;

    /**
     * RoomCouponsController constructor.
     *
     * @param RoomCouponRepository $repository
     * @param RoomCouponValidator $validator
     */
    public function __construct(RoomCouponRepository $repository, RoomCouponValidator $validator)
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
        $roomCoupons = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $roomCoupons,
            ]);
        }

        return view('roomCoupons.index', compact('roomCoupons'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RoomCouponCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(RoomCouponCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $roomCoupon = $this->repository->create($request->all());

            $response = [
                'message' => 'RoomCoupon created.',
                'data'    => $roomCoupon->toArray(),
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
        $roomCoupon = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $roomCoupon,
            ]);
        }

        return view('roomCoupons.show', compact('roomCoupon'));
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
        $roomCoupon = $this->repository->find($id);

        return view('roomCoupons.edit', compact('roomCoupon'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  RoomCouponUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(RoomCouponUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $roomCoupon = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'RoomCoupon updated.',
                'data'    => $roomCoupon->toArray(),
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
                'message' => 'RoomCoupon deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'RoomCoupon deleted.');
    }
}
