<?php

namespace Hotel\Http\Controllers\Api;

use Hotel\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Hotel\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Hotel\Http\Requests\TestimonialCreateRequest;
use Hotel\Http\Requests\TestimonialUpdateRequest;
use Hotel\Repositories\TestimonialRepository;
use Hotel\Validators\TestimonialValidator;

/**
 * Class TestimonialsController.
 *
 * @package namespace Hotel\Http\Controllers;
 */
class TestimonialsController extends Controller
{
    /**
     * @var TestimonialRepository
     */
    protected $repository;

    /**
     * @var TestimonialValidator
     */
    protected $validator;

    /**
     * TestimonialsController constructor.
     *
     * @param TestimonialRepository $repository
     * @param TestimonialValidator $validator
     */
    public function __construct(TestimonialRepository $repository, TestimonialValidator $validator)
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
        $testimonials = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $testimonials,
            ]);
        }

        return view('testimonials.index', compact('testimonials'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  TestimonialCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(TestimonialCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $testimonial = $this->repository->create($request->all());

            $response = [
                'message' => 'Testimonial created.',
                'data'    => $testimonial->toArray(),
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
        $testimonial = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $testimonial,
            ]);
        }

        return view('testimonials.show', compact('testimonial'));
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
        $testimonial = $this->repository->find($id);

        return view('testimonials.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  TestimonialUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(TestimonialUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $testimonial = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'Testimonial updated.',
                'data'    => $testimonial->toArray(),
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
                'message' => 'Testimonial deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'Testimonial deleted.');
    }
}
