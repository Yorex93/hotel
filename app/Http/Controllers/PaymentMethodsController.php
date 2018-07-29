<?php

namespace Hotel\Http\Controllers;

use Illuminate\Http\Request;

use Hotel\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Hotel\Http\Requests\PaymentMethodCreateRequest;
use Hotel\Http\Requests\PaymentMethodUpdateRequest;
use Hotel\Repositories\PaymentMethodRepository;
use Hotel\Validators\PaymentMethodValidator;

/**
 * Class PaymentMethodsController.
 *
 * @package namespace Hotel\Http\Controllers;
 */
class PaymentMethodsController extends Controller
{
    /**
     * @var PaymentMethodRepository
     */
    protected $repository;

    /**
     * @var PaymentMethodValidator
     */
    protected $validator;

    /**
     * PaymentMethodsController constructor.
     *
     * @param PaymentMethodRepository $repository
     * @param PaymentMethodValidator $validator
     */
    public function __construct(PaymentMethodRepository $repository, PaymentMethodValidator $validator)
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
        $paymentMethods = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $paymentMethods,
            ]);
        }

        return view('paymentMethods.index', compact('paymentMethods'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PaymentMethodCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(PaymentMethodCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $paymentMethod = $this->repository->create($request->all());

            $response = [
                'message' => 'PaymentMethod created.',
                'data'    => $paymentMethod->toArray(),
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
        $paymentMethod = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $paymentMethod,
            ]);
        }

        return view('paymentMethods.show', compact('paymentMethod'));
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
        $paymentMethod = $this->repository->find($id);

        return view('paymentMethods.edit', compact('paymentMethod'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PaymentMethodUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(PaymentMethodUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $paymentMethod = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'PaymentMethod updated.',
                'data'    => $paymentMethod->toArray(),
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
                'message' => 'PaymentMethod deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'PaymentMethod deleted.');
    }
}
