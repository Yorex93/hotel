<?php

namespace Hotel\Http\Controllers\Api;

use Illuminate\Http\Request;
use Hotel\Http\Controllers\Controller;

use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Hotel\Http\Requests\ContactPersonCreateRequest;
use Hotel\Http\Requests\ContactPersonUpdateRequest;
use Hotel\Repositories\ContactPersonRepository;
use Hotel\Validators\ContactPersonValidator;

/**
 * Class ContactPeopleController.
 *
 * @package namespace Hotel\Http\Controllers\Api;
 */
class ContactPeopleController extends Controller
{
    /**
     * @var ContactPersonRepository
     */
    protected $repository;

    /**
     * @var ContactPersonValidator
     */
    protected $validator;

    /**
     * ContactPeopleController constructor.
     *
     * @param ContactPersonRepository $repository
     * @param ContactPersonValidator $validator
     */
    public function __construct(ContactPersonRepository $repository, ContactPersonValidator $validator)
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
        $contactPeople = $this->repository->all();

        if (request()->wantsJson()) {
            return response()->json([
                'data' => $contactPeople,
            ]);
        }

        return view('contactPeople.index', compact('contactPeople'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  ContactPersonCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(ContactPersonCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $contactPerson = $this->repository->create($request->all());

            $response = [
                'message' => 'ContactPerson created.',
                'data'    => $contactPerson->toArray(),
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
        $contactPerson = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $contactPerson,
            ]);
        }

        return view('contactPeople.show', compact('contactPerson'));
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
        $contactPerson = $this->repository->find($id);

        return view('contactPeople.edit', compact('contactPerson'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  ContactPersonUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(ContactPersonUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $contactPerson = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'ContactPerson updated.',
                'data'    => $contactPerson->toArray(),
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
                'message' => 'ContactPerson deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'ContactPerson deleted.');
    }
}
