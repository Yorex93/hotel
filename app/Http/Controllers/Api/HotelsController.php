<?php

namespace Hotel\Http\Controllers\Api;

use Hotel\Http\Controllers\Controller;
use Hotel\Services\Hotel\HotelService;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use Illuminate\Http\Request;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Hotel\Http\Requests\HotelCreateRequest;
use Hotel\Http\Requests\HotelUpdateRequest;
use Hotel\Validators\HotelValidator;

/**
 * Class HotelsController.
 *
 * @package namespace Hotel\Http\Controllers\Api;
 */
class HotelsController extends Controller
{
    /**
     * @var HotelService
     */
    protected $hotelService;

    /**
     * @var HotelValidator
     */
    protected $validator;

	/**
	 * HotelsController constructor.
	 *
	 * @param HotelService $hotel_service
	 * @param HotelValidator $validator
	 */
    public function __construct(HotelService $hotel_service, HotelValidator $validator)
    {
	    $this->middleware('permission:create hotel', ['only' => ['store']]);
	    $this->middleware('permission:update hotel', ['only' => ['update']]);
	    $this->middleware('permission:delete hotel', ['only' => ['destroy']]);
        $this->hotelService = $hotel_service;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $hotels = $this->hotelService->getHotels();

        return response()->json([
            'data' => $hotels,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  HotelCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function store(HotelCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $hotel = $this->hotelService->createHotel($request);

            $response = [
                'message' => 'Hotel created.',
                'data'    => $hotel->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
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
    	$hotel = null;
    	try{
		    $hotel = $this->hotelService->getHotelById($id);
	    } catch (ModelNotFoundException $ex){
		    return response()->json([ 'error' => 'Hotel Not found' ], 404);
	    }
	    return response()->json([ 'data' => $hotel ], 200);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  HotelUpdateRequest $request
     * @param  string            $id
     *
     * @return \Illuminate\Http\Response
     *
     */
    public function update(HotelUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $hotel = $this->hotelService->updateHotel($id, $request);

            $response = [
                'message' => 'Hotel updated.',
                'data'    => $hotel->toArray(),
            ];

            return response()->json($response, 200);

        } catch (ValidatorException $e) {
            return response()->json([
                'error'   => true,
                'message' => $e->getMessageBag()
            ], 400);
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
        $deleted = $this->hotelService->deleteHotel($id);
        return response()->json([
            'message' => 'Hotel deleted.',
            'deleted' => $deleted,
        ]);
    }


    public function addMedia( Request $request, $id){
    	try{
		    $hotel = $this->hotelService->getHotelById($id);
	    } catch (ModelNotFoundException $exception){
		    return response()->json([
			    'message' => 'Hotel with id '.$id.' does not exist',
			    'error' => 'Hotel not found',
		    ], 404);
	    }

	    $this->validate($request, [
		    'files' => 'required',
		    'files.*' => 'mimes:jpg,pdf,png,jpeg,svg,doc,docx'
	    ]);

    	$media = $this->hotelService->addMedia($request->file('files'), $hotel);

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
