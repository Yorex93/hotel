<?php

namespace Hotel\Http\Controllers\Api;

use Hotel\Services\Facility\FacilityService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Hotel\Http\Controllers\Controller;

use Hotel\Http\Requests;
use Illuminate\Support\Facades\Response;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Hotel\Http\Requests\FacilityCreateRequest;
use Hotel\Http\Requests\FacilityUpdateRequest;
use Hotel\Repositories\FacilityRepository;
use Hotel\Validators\FacilityValidator;

/**
 * Class FacilitiesController.
 *
 * @package namespace Hotel\Http\Controllers\Api;
 */
class FacilitiesController extends Controller
{
    /**
     * @var FacilityService
     */
    protected $facilityService;

    /**
     * @var FacilityValidator
     */
    protected $validator;

	/**
	 * FacilitiesController constructor.
	 *
	 * @param FacilityService $facility_service
	 * @param FacilityValidator $validator
	 */
    public function __construct(FacilityService $facility_service, FacilityValidator $validator)
    {
        $this->facilityService = $facility_service;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facilities = $this->facilityService->getAllFacilities();
        return response()->json([ 'data' => $facilities ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FacilityCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function store(FacilityCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $facility = $this->facilityService->createFacility($request);

            $response = [
                'message' => 'Facility created.',
                'data'    => $facility->toArray(),
            ];

            return response()->json($response);

        } catch (ValidatorException $e) {
            return response()->json([
                'error'   => true,
                'message' => $e->getMessageBag()
            ], 400);
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
        $facility = $this->facilityService->getFacilityById($id);

        return response()->json([
            'data' => $facility,
        ]);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  FacilityUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     */
    public function update(FacilityUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $facility = $this->facilityService->updateFacility($id, $request);

            $response = [
                'message' => 'Facility updated.',
                'data'    => $facility->toArray(),
            ];


            return response()->json($response);

        } catch (ValidatorException $e) {

            return response()->json([
                'error'   => true,
                'message' => $e->getMessageBag()
            ], 400);

        } catch ( \Exception $e ) {

	        return response()->json([
		        'error'   => true,
		        'message' => $e->getMessage()
	        ], 500);

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
        $deleted = $this->facilityService->deleteFacilityById($id);

            return response()->json([
                'message' => 'Facility deleted.',
                'deleted' => $deleted,
            ], 201);

    }


	public function addMedia( Request $request, $id){
		try{
			$facility = $this->facilityService->getFacilityById($id);
		} catch (ModelNotFoundException $exception){
			return response()->json([
				'message' => 'Facility with id '.$id.' does not exist',
				'error' => 'Facility not found',
			], 404);
		}

		$this->validate($request, [
			'files' => 'required',
			'files.*' => 'mimes:jpg,pdf,png,jpeg,svg,doc,docx'
		]);

		$media = $this->facilityService->addMedia($request->file('files'), $facility);

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
