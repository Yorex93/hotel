<?php

namespace Hotel\Http\Api\Controllers;

use Hotel\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Hotel\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Hotel\Http\Requests\HotelSocialCreateRequest;
use Hotel\Http\Requests\HotelSocialUpdateRequest;
use Hotel\Repositories\HotelSocialRepository;
use Hotel\Validators\HotelSocialValidator;

/**
 * Class HotelSocialsController.
 *
 * @package namespace Hotel\Http\Api\Controllers;
 */
class HotelSocialsController extends Controller
{
    /**
     * @var HotelSocialRepository
     */
    protected $repository;

    /**
     * @var HotelSocialValidator
     */
    protected $validator;

    /**
     * HotelSocialsController constructor.
     *
     * @param HotelSocialRepository $repository
     * @param HotelSocialValidator $validator
     */
    public function __construct(HotelSocialRepository $repository, HotelSocialValidator $validator)
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
        $hotelSocials = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $hotelSocials,
            ]);
        }

        return view('hotelSocials.index', compact('hotelSocials'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  HotelSocialCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(HotelSocialCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $hotelSocial = $this->repository->create($request->all());

            $response = [
                'message' => 'HotelSocial created.',
                'data'    => $hotelSocial->toArray(),
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
        $hotelSocial = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $hotelSocial,
            ]);
        }

        return view('hotelSocials.show', compact('hotelSocial'));
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
        $hotelSocial = $this->repository->find($id);

        return view('hotelSocials.edit', compact('hotelSocial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  HotelSocialUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(HotelSocialUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $hotelSocial = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'HotelSocial updated.',
                'data'    => $hotelSocial->toArray(),
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
                'message' => 'HotelSocial deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'HotelSocial deleted.');
    }
}
