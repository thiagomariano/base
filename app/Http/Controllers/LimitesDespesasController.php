<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\LimitesDespesasCreateRequest;
use App\Http\Requests\LimitesDespesasUpdateRequest;
use App\Repositories\LimitesDespesasRepository;
use App\Validators\LimitesDespesasValidator;


class LimitesDespesasController extends Controller
{

    /**
     * @var LimitesDespesasRepository
     */
    protected $repository;

    /**
     * @var LimitesDespesasValidator
     */
    protected $validator;

    public function __construct(LimitesDespesasRepository $repository, LimitesDespesasValidator $validator)
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
        $limitesDespesas = $this->repository->all();

        return response()->json([
            'data' => $limitesDespesas,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  LimitesDespesasCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(LimitesDespesasCreateRequest $request)
    {
        try {
            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $limitesDespesa = $this->repository->create($request->all());

            $response = [
                'message' => 'LimitesDespesas created.',
                'data' => $limitesDespesa->toArray(),
            ];

            return response()->json($response);

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
        $limitesDespesa = $this->repository->find($id);

        return response()->json([
            'data' => $limitesDespesa,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  LimitesDespesasUpdateRequest $request
     * @param  string $id
     *
     * @return Response
     */
    public function update(LimitesDespesasUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $limitesDespesa = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'LimitesDespesas updated.',
                'data' => $limitesDespesa->toArray(),
            ];

            return response()->json($response);

        } catch (ValidatorException $e) {

            return response()->json([
                'error' => true,
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
        $deleted = $this->repository->delete($id);

        return response()->json([
            'message' => 'LimitesDespesas deleted.',
            'deleted' => $deleted,
        ]);
    }
}
