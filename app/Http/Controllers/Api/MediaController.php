<?php

namespace Hotel\Http\Controllers\Api;

use Hotel\Http\Controllers\Controller;
use Hotel\Services\Media\MediaService;
use Illuminate\Http\Request;

use Hotel\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Hotel\Http\Requests\MediaCreateRequest;
use Hotel\Http\Requests\MediaUpdateRequest;
use Hotel\Repositories\MediaRepository;
use Hotel\Validators\MediaValidator;

/**
 * Class MediaController.
 *
 * @package namespace Hotel\Http\Controllers\Api;
 */
class MediaController extends Controller
{
    /**
     * @var MediaService
     */
    protected $mediaService;

    /**
     * @var MediaValidator
     */
    protected $validator;

	/**
	 * MediaController constructor.
	 *
	 * @param MediaService $media_service
	 * @param MediaValidator $validator
	 */
    public function __construct(MediaService $media_service, MediaValidator $validator)
    {
        $this->mediaService = $media_service;
        $this->validator  = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      return null;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MediaCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(MediaCreateRequest $request)
    {
//        try {
//
//            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
//
//            $medium = $this->repository->create($request->all());
//
//            $response = [
//                'message' => 'Media created.',
//                'data'    => $medium->toArray(),
//            ];
//
//            if ($request->wantsJson()) {
//
//                return response()->json($response);
//            }
//
//            return redirect()->back()->with('message', $response['message']);
//        } catch (ValidatorException $e) {
//            if ($request->wantsJson()) {
//                return response()->json([
//                    'error'   => true,
//                    'message' => $e->getMessageBag()
//                ]);
//            }
//
//            return redirect()->back()->withErrors($e->getMessageBag())->withInput();
//        }
	    return null;
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
//        $medium = $this->repository->find($id);
//
//        if (request()->wantsJson()) {
//
//            return response()->json([
//                'data' => $medium,
//            ]);
//        }
//
//        return view('media.show', compact('medium'));
	    return null;
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
//        $deleted = $this->repository->delete($id);
//
//        if (request()->wantsJson()) {
//
//            return response()->json([
//                'message' => 'Media deleted.',
//                'deleted' => $deleted,
//            ]);
//        }

        return null;
    }


    public function deleteAll(Request $request){
	    $this->validate($request, [
		    'mediaIds' => 'required | array | filled',
	    ]);

	    if($this->mediaService->deleteAll($request->get('mediaIds'))){
	    	return response()->json([
	    		'message' => 'Deleted successfully'
		    ], 200);
	    } else {
		    return response()->json([
			    'error' => 'There was an error deleting files'
		    ], 500);
	    }
    }
}
