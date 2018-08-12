<?php

namespace Hotel\Http\Controllers\Api;

use Hotel\Http\Controllers\Controller;
use Hotel\Services\RoomType\RoomTypeService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

use Hotel\Http\Requests;
use Illuminate\Http\Response;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Hotel\Http\Requests\RoomTypeCreateRequest;
use Hotel\Http\Requests\RoomTypeUpdateRequest;
use Hotel\Repositories\RoomTypeRepository;
use Hotel\Validators\RoomTypeValidator;

/**
 * Class RoomTypesController.
 *
 * @package namespace Hotel\Http\Controllers\Api;
 */
class RoomTypesController extends Controller
{
    /**
     * @var RoomTypeService
     */
    protected $roomTypeService;

    /**
     * @var RoomTypeValidator
     */
    protected $validator;

	/**
	 * RoomTypesController constructor.
	 *
	 * @param RoomTypeService $room_type_service
	 * @param RoomTypeValidator $validator
	 */
    public function __construct(RoomTypeService $room_type_service, RoomTypeValidator $validator)
    {
        $this->roomTypeService = $room_type_service;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roomTypes = $this->roomTypeService->getAll();
        return response()->json([
            'data' => $roomTypes,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RoomTypeCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function store(RoomTypeCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $roomType = $this->roomTypeService->create($request);

            $response = [
                'message' => 'RoomType created.',
                'data'    => $roomType->toArray(),
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
    	try{
		    $roomType = $this->roomTypeService->getById($id);
		    return response()->json([ 'data' => $roomType ]);
	    } catch (ModelNotFoundException $exception){
		    return response()->json([ 'error' => 'Not Found', 'message' => 'Room type with id '.$id.' not found' ], 404);
	    }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  RoomTypeUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     */
    public function update(RoomTypeUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $roomType = $this->roomTypeService->update($request, $id);

            $response = [
                'message' => 'RoomType updated.',
                'data'    => $roomType->toArray(),
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
        $deleted = $this->roomTypeService->delete($id);

            return response()->json([
                'message' => 'RoomType deleted.',
                'deleted' => $deleted,
            ]);

    }

	public function addMedia( Request $request, $id){
		try{
			$roomType = $this->roomTypeService->getById($id);
		} catch (ModelNotFoundException $exception){
			return response()->json([ 'error' => 'Not Found', 'message' => 'Room type with id '.$id.' not found' ], 404);
		}

		$this->validate($request, [
			'files' => 'required',
			'files.*' => 'mimes:jpg,pdf,png,jpeg,svg,doc,docx'
		]);

		$media = $this->roomTypeService->addMedia($request->file('files'), $roomType);

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
