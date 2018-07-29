<?php

namespace Hotel\Http\Controllers;

use Illuminate\Http\Request;

use Hotel\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Hotel\Http\Requests\TaxCreateRequest;
use Hotel\Http\Requests\TaxUpdateRequest;
use Hotel\Repositories\TaxRepository;
use Hotel\Validators\TaxValidator;

/**
 * Class TaxesController.
 *
 * @package namespace Hotel\Http\Controllers;
 */
class TaxesController extends Controller
{
    /**
     * @var TaxRepository
     */
    protected $repository;

    /**
     * @var TaxValidator
     */
    protected $validator;

    /**
     * TaxesController constructor.
     *
     * @param TaxRepository $repository
     * @param TaxValidator $validator
     */
    public function __construct(TaxRepository $repository, TaxValidator $validator)
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
        $taxes = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $taxes,
            ]);
        }

        return view('taxes.index', compact('taxes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TaxCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(TaxCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $tax = $this->repository->create($request->all());

            $response = [
                'message' => 'Tax created.',
                'data'    => $tax->toArray(),
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
        $tax = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $tax,
            ]);
        }

        return view('taxes.show', compact('tax'));
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
        $tax = $this->repository->find($id);

        return view('taxes.edit', compact('tax'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TaxUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TaxUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $tax = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Tax updated.',
                'data'    => $tax->toArray(),
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
                'message' => 'Tax deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Tax deleted.');
    }
}
