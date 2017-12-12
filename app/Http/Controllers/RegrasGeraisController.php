<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;
use App\Http\Requests\RegrasGeraisCreateRequest;
use App\Http\Requests\RegrasGeraisUpdateRequest;
use App\Repositories\RegrasGeraisRepository;
use App\Validators\RegrasGeraisValidator;


class RegrasGeraisController extends Controller
{

    /**
     * @var RegrasGeraisRepository
     */
    protected $repository;

    /**
     * @var RegrasGeraisValidator
     */
    protected $validator;

    public function __construct(RegrasGeraisRepository $repository, RegrasGeraisValidator $validator)
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
        $regrasGerais = $this->repository->all();

        return response()->json([
            'data' => $regrasGerais,
        ]);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  RegrasGeraisCreateRequest $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(RegrasGeraisCreateRequest $request)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $regrasGerais = $this->repository->create($request->all());

            $response = [
                'message' => 'RegrasGerais created.',
                'data' => $regrasGerais->toArray(),
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
        $regrasGerai = $this->repository->find($id);

        return response()->json([
            'data' => $regrasGerai,
        ]);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  RegrasGeraisUpdateRequest $request
     * @param  string $id
     *
     * @return Response
     */
    public function update(RegrasGeraisUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);

            $regrasGerai = $this->repository->update($request->all(), $id);

            $response = [
                'message' => 'RegrasGerais updated.',
                'data' => $regrasGerai->toArray(),
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
            'message' => 'RegrasGerais deleted.',
            'deleted' => $deleted,
        ]);

    }
}
