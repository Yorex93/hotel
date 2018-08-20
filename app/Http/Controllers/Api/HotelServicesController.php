<?php

namespace Hotel\Http\Controllers\Api;

use Hotel\Http\Controllers\Controller;
use Hotel\Services\HotelServices\HotelServicesService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Response;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Hotel\Validators\HotelServiceValidator;

/**
 * Class HotelServicesController.
 *
 * @package namespace Hotel\Http\Controllers;
 */
class HotelServicesController extends Controller
{
    /**
     * @var HotelServicesService
     */
    protected $hotelServicesService;

    /**
     * @var HotelServiceValidator
     */
    protected $validator;

	/**
	 * HotelServicesController constructor.
	 *
	 * @param HotelServicesService $hotel_services_service
	 * @param HotelServiceValidator $validator
	 */
    public function __construct(HotelServicesService $hotel_services_service, HotelServiceValidator $validator)
    {
        $this->hotelServicesService = $hotel_services_service;
        $this->validator  = $validator;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @param Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
    public function index(Request $request)
    {
    	if($request->has('parents')) {
    		return $this->parents();
	    }

        $hotelServices = $this->hotelServicesService->findAll();

        return response()->json([
            'data' => $hotelServices,
        ]);

    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function parents()
	{
		$hotelServices = $this->hotelServicesService->fetchParents();
		return response()->json([
			'data' => $hotelServices,
		]);

	}

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function store(Request $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $hotelService = $this->hotelServicesService->create($request);

            $response = [
                'message' => 'HotelService created.',
                'data'    => $hotelService->toArray(),
            ];


            return response()->json($response);

        } catch (ValidatorException $e) {
            return response()->json([
                'error'   => true,
                'message' => $e->getMessageBag()
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     * @param  string            $id
     *
     * @return Response
     *
     */
    public function update(Request $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $hotelService = $this->hotelServicesService->update($id, $request);

            $response = [
                'message' => 'HotelService updated.',
                'data'    => $hotelService->toArray(),
            ];

            return response()->json($response);
        } catch (ValidatorException $e) {
            return response()->json([
                'error'   => true,
                'message' => $e->getMessageBag()
            ]);
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
        $deleted = $this->hotelServicesService->delete($id);


        return response()->json([
            'message' => 'HotelService deleted.',
            'deleted' => $deleted,
        ]);

    }


	public function addMedia( Request $request, $id){
		try{
			$hotelService = $this->hotelServicesService->findById($id);
		} catch (ModelNotFoundException $exception){
			return response()->json([
				'message' => 'Hotel Service with id '.$id.' does not exist',
				'error' => 'Hotel not found',
			], 404);
		}

		$this->validate($request, [
			'files' => 'required',
			'files.*' => 'mimes:jpg,pdf,png,jpeg,svg,doc,docx'
		]);

		$media = $this->hotelServicesService->addMedia($request->file('files'), $hotelService);

		if($media === null || count($media) === 0){
			return response()->json([
				'message' => 'Error',
				'error' => 'Error uploading media',
			], 400);
		}

		return response()->json([
			'message' => 'Media Added',
			'data' => $media,
		]);
	}
}
