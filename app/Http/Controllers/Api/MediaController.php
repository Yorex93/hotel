<?php

namespace Hotel\Http\Api\Controllers;

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
 * @package namespace Hotel\Http\Api\Controllers;
 */
class MediaController extends Controller
{
    /**
     * @var MediaRepository
     */
    protected $repository;

    /**
     * @var MediaValidator
     */
    protected $validator;

    /**
     * MediaController constructor.
     *
     * @param MediaRepository $repository
     * @param MediaValidator $validator
     */
    public function __construct(MediaRepository $repository, MediaValidator $validator)
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
        $media = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $media,
            ]);
        }

        return view('media.index', compact('media'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  MediaCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(MediaCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $medium = $this->repository->create($request->all());

            $response = [
                'message' => 'Media created.',
                'data'    => $medium->toArray(),
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
        $medium = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $medium,
            ]);
        }

        return view('media.show', compact('medium'));
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
        $medium = $this->repository->find($id);

        return view('media.edit', compact('medium'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  MediaUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(MediaUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $medium = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Media updated.',
                'data'    => $medium->toArray(),
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
                'message' => 'Media deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Media deleted.');
    }
}
