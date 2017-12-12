<?php

namespace App\Http\Controllers;

use App\Entities\Despesas;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\DespesasCreateRequest;
use App\Http\Requests\DespesasUpdateRequest;
use App\Repositories\DespesasRepository;
use App\Validators\DespesasValidator;


class DespesasController extends Controller
{

    /**
     * @var DespesasRepository
     */
    protected $repository;

    /**
     * @var DespesasValidator
     */
    protected $validator;

    public function __construct(DespesasRepository $repository, DespesasValidator $validator)
    {
        $this->repository = $repository;
        $this->validator = $validator;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $despesas = $this->repository->all();

        return response()->json([
            'data' => $despesas,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  DespesasCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(DespesasCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);
            $despesa = $this->repository->create($request->all());

            $response = [
                'message' => 'Despesas created.',
                'data' => $despesa->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {
            if ($request->wantsJson()) {
                return response()->json([
                    'error' => true,
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
        $despesa = $this->repository->find($id);
        return response()->json([
            'data' => $despesa,
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  DespesasUpdateRequest $request
     * @param  string $id
     *
     * @return Response
     */
    public function update(DespesasUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $despesa = $this->repository->update($request->all(), $id);
            $response = [
                'message' => 'Despesas updated.',
                'data' => $despesa->toArray(),
            ];

            if ($request->wantsJson()) {

                return response()->json($response);
            }

            return redirect()->back()->with('message', $response['message']);
        } catch (ValidatorException $e) {

            if ($request->wantsJson()) {

                return response()->json([
                    'error' => true,
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
        return response()->json([
            'message' => 'Despesas deleted.',
            'deleted' => $deleted,
        ]);

    }
}
