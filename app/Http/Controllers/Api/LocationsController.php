<?php

namespace Hotel\Http\Controllers\Api;

use Hotel\Http\Controllers\Controller;
use Hotel\Services\Hotel\HotelService;
use Hotel\Services\Location\LocationService;
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
 * @package namespace Hotel\Http\Controllers\Api;
 */
class LocationsController extends Controller
{
    /**
     * @var LocationService
     */
    protected $locationService;

    /**
     * @var LocationValidator
     */
    protected $validator;

	/**
	 * @var HotelService
	 */
    protected $hotelService;

	/**
	 * LocationsController constructor.
	 *
	 * @param LocationService $location_service
	 * @param LocationValidator $validator
	 * @param HotelService $hotel_service
	 */

    public function __construct(LocationService $location_service, LocationValidator $validator, HotelService $hotel_service)
    {
        $this->locationService = $location_service;
        $this->validator  = $validator;
        $this->hotelService = $hotel_service;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $locations = $this->locationService->getAllLocations();
            return response()->json([
                'data' => $locations,
            ]);
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

            $location = $this->locationService->createLocation($request);

            $response = [
                'message' => 'Location created.',
                'data'    => $location->toArray(),
            ];

            if($request->has('hotel_id')){
            	$this->hotelService->setLocation($request->get('hotel_id'), $location);
            }

            return response()->json($response);

        } catch (ValidatorException $e) {
                return response()->json([
                    'error'   => true,
                    'message' => $e->getMessageBag()
                ], 400);
        }
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

            $location = $this->locationService->updateLocation($request, $id);

            $response = [
                'message' => 'Location updated.',
                'data'    => $location->toArray(),
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
        $deleted = $this->locationService->deleteLocation($id);
        return response()->json([
            'message' => 'Location deleted.',
            'deleted' => $deleted,
        ]);
    }

    public function countries(){
		return response()->json([
			'data' => $this->locationService->getCountries()
		]);
    }

	public function states(int $id){
		return response()->json([
			'data' => $this->locationService->getStatesByCountry($id)
		]);
	}
}
