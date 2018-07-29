<?php

namespace Hotel\Http\Controllers;

use Illuminate\Http\Request;

use Hotel\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use Hotel\Http\Requests\EmailTemplateCreateRequest;
use Hotel\Http\Requests\EmailTemplateUpdateRequest;
use Hotel\Repositories\EmailTemplateRepository;
use Hotel\Validators\EmailTemplateValidator;

/**
 * Class EmailTemplatesController.
 *
 * @package namespace Hotel\Http\Controllers;
 */
class EmailTemplatesController extends Controller
{
    /**
     * @var EmailTemplateRepository
     */
    protected $repository;

    /**
     * @var EmailTemplateValidator
     */
    protected $validator;

    /**
     * EmailTemplatesController constructor.
     *
     * @param EmailTemplateRepository $repository
     * @param EmailTemplateValidator $validator
     */
    public function __construct(EmailTemplateRepository $repository, EmailTemplateValidator $validator)
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
        $emailTemplates = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $emailTemplates,
            ]);
        }

        return view('emailTemplates.index', compact('emailTemplates'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  EmailTemplateCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function store(EmailTemplateCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $emailTemplate = $this->repository->create($request->all());

            $response = [
                'message' => 'EmailTemplate created.',
                'data'    => $emailTemplate->toArray(),
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
        $emailTemplate = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $emailTemplate,
            ]);
        }

        return view('emailTemplates.show', compact('emailTemplate'));
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
        $emailTemplate = $this->repository->find($id);

        return view('emailTemplates.edit', compact('emailTemplate'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  EmailTemplateUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     *
     * @throws \Prettus\Validator\Exceptions\ValidatorException
     */
    public function update(EmailTemplateUpdateRequest $request, $id)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $emailTemplate = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'EmailTemplate updated.',
                'data'    => $emailTemplate->toArray(),
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
                'message' => 'EmailTemplate deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'EmailTemplate deleted.');
    }
}
