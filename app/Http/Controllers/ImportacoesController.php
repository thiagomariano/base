<?php

namespace App\Http\Controllers;

use App\Http\Requests\ImportacaoUpdateRequest;
use App\Http\Requests\ImportacoesCreateRequest;
use App\Repositories\DespesasImportadasRepository;
use App\Repositories\DespesasRepository;
use App\Repositories\ImportacoesRepository;
use App\Validators\ImportacoesValidator;
use Illuminate\Http\Request;

use App\Http\Requests;
use Prettus\Validator\Contracts\ValidatorInterface;
use Prettus\Validator\Exceptions\ValidatorException;


class ImportacoesController extends Controller
{
    /**
     * @var ImportacoesRepository
     */
    private $repository;
    /**
     * @var ImportacoesValidator
     */
    private $validator;
    /**
     * @var DespesasRepository
     */
    private $despesasRepository;
    /**
     * @var DespesasImportadasRepository
     */
    private $despesasImportadasRepository;

    /**
     * ImportacoesController constructor.
     * @param ImportacoesRepository $repository
     * @param ImportacoesValidator $validator
     * @param DespesasRepository $despesasRepository
     * @param DespesasImportadasRepository $despesasImportadasRepository
     */
    public function __construct(
        ImportacoesRepository $repository,
        ImportacoesValidator $validator,
        DespesasRepository $despesasRepository,
        DespesasImportadasRepository $despesasImportadasRepository)
    {
        $this->repository = $repository;
        $this->validator = $validator;
        $this->despesasRepository = $despesasRepository;
        $this->despesasImportadasRepository = $despesasImportadasRepository;
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));
        $importacoes = $this->repository->all();

        return $importacoes;
    }

    /**
     * @param ImportacoesCreateRequest $request
     * @return $this|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function store(ImportacoesCreateRequest $request)
    {
        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_CREATE);

            $totalDespesas = count($this->despesasRepository->all());

            $dados = $request->all();
            $dados['quantidade_itens'] = $totalDespesas;

            $idImportacao = $this->repository->create($dados);

            $this->importar($idImportacao['data']['codigo']);

            $response = [
                'status' => '200'
            ];

            return $response;

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
     *
     */
    public function importar($idImportacao)
    {
        $this->repository->pushCriteria(app('Prettus\Repository\Criteria\RequestCriteria'));

        $despesas = $this->despesasRepository->all();
        $array = array();

        foreach ($despesas as $dados) {
            $array[] = [
                "descricao" => $dados->descricao,
                "ano" => $dados->ano,
                "opcao_reflexo_ano" => $dados->opcao_reflexo_ano,
                "unidade_gestora" => $dados->unidade_gestora,
                "responsavel" => $dados->responsavel,
                "esfera" => $dados->esfera,
                "ptres" => $dados->ptres,
                "unidade_orcamentaria" => $dados->unidade_orcamentaria,
                "natureza_despesa" => $dados->natureza_despesa,
                "carater_despesa" => $dados->carater_despesa,
                "fonte" => $dados->fonte,
                "categoria" => $dados->categoria,
                "vinculacao" => $dados->vinculacao,
                "tipo_recurso" => $dados->tipo_recurso,
                "tipo_orcamento" => $dados->tipo_orcamento,
                "perspectiva" => $dados->perspectiva,
                "macrodesafio" => $dados->macrodesafio,
                "objetivo" => $dados->objetivo,
                "programa" => $dados->programa,
                "tipo_operacional" => $dados->tipo_operacional,
                "numero_contrato" => $dados->numero_contrato,
                "nome_empresa_contratada" => $dados->nome_empresa_contratada,
                "cpf_cnpj_contratada" => $dados->cpf_cnpj_contratada,
                "inicio_vigencia" => $dados->inicio_vigencia,
                "termino_vigencia" => $dados->termino_vigencia,
                "valor_contrato" => $dados->valor_contrato,
                "dotacao_autorizada_exercicio_anterior" => $dados->dotacao_autorizada_exercicio_anterior,
                "dase_exercicio_anterior" => $dados->dase_exercicio_anterior,
                "reajuste" => $dados->reajuste,
                "reajuste_aplicado" => $dados->reajuste_aplicado,
                "base_exercicio_atual" => $dados->base_exercicio_atual,
                "proposta_inicial" => $dados->proposta_inicial,
                "solicitado_pelo_responsavel" => $dados->solicitado_pelo_responsavel,
                "ajuste_setorial_pre_proposta" => $dados->ajuste_setorial_pre_proposta,
                "proposta_ajustada_limite" => $dados->proposta_ajustada_limite,
                "orcamento_aprovado" => $dados->orcamento_aprovado,
                "valor_mensal_maximo_autorizado" => $dados->valor_mensal_maximo_autorizado,
                "idImportacao" => $idImportacao
            ];

        }

        foreach($array as $dados){
            $this->despesasImportadasRepository->create($dados);
        }

        unset($array['idImportacao']);
        foreach($array as $dados){
            $this->despesasRepository->create($dados);
        }

        $response = [
            'status' => '200'
        ];

        return $response;


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
        return $this->repository->find($id);
    }

    /**
     * @param ImportacaoUpdateRequest $request
     * @param $id
     * @return $this|\Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function update(ImportacaoUpdateRequest $request, $id)
    {

        try {

            $this->validator->with($request->all())->passesOrFail(ValidatorInterface::RULE_UPDATE);
            $this->repository->update($request->all(), $id);
            $response = [
                'status' => '200'
            ];

            return $response;

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
        $this->repository->delete($id);
        return response()->json([
            'status' => '200',
        ]);

    }
}
