<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\DespesasImportadasCreateRequest;
use App\Http\Requests\DespesasImportadasUpdateRequest;
use App\Repositories\DespesasImportadasRepository;
use App\Validators\DespesasImportadasValidator;


class DespesasImportadasController extends Controller
{

    /**
     * @var DespesasImportadasRepository
     */
    protected $repository;

    /**
     * @var DespesasImportadasValidator
     */
    protected $validator;

    public function __construct(DespesasImportadasRepository $repository, DespesasImportadasValidator $validator)
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
        $despesasImportadas = $this->repository->all();

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $despesasImportadas,
            ]);
        }

        return view('despesasImportadas.index', compact('despesasImportadas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  DespesasImportadasCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(DespesasImportadasCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $despesasImportada = $this->repository->create($request->all());

            $response = [
                'message' => 'DespesasImportadas created.',
                'data'    => $despesasImportada->toArray(),
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
        $despesasImportada = $this->repository->find($id);

        if (request()->wantsJson()) {

            return response()->json([
                'data' => $despesasImportada,
            ]);
        }

        return view('despesasImportadas.show', compact('despesasImportada'));
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

        $despesasImportada = $this->repository->find($id);

        return view('despesasImportadas.edit', compact('despesasImportada'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  DespesasImportadasUpdateRequest $request
     * @param  string            $id
     *
     * @return Response
     */
    public function update(DespesasImportadasUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $despesasImportada = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'DespesasImportadas updated.',
                'data'    => $despesasImportada->toArray(),
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
                'message' => 'DespesasImportadas deleted.',
                'deleted' => $deleted,
            ]);
        }

        return redirect()->back()->with('message', 'DespesasImportadas deleted.');
    }
}
