<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDespesasTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('despesas', function (Blueprint $table) {
            $table->increments('id');

            #Resumo
            $table->string('descricao')->nullable();
            $table->string('ano')->nullable();
            $table->string('opcao_reflexo_ano')->nullable();

            #Gestor
            $table->string('unidade_gestora')->nullable();
            $table->string('responsavel')->nullable();

            #Célula Orçamentária
            $table->string('esfera')->nullable();
            $table->string('ptres')->nullable();
            $table->string('unidade_orcamentaria')->nullable();
            $table->string('natureza_despesa')->nullable();
            $table->string('carater_despesa')->nullable();

            #Identificação Financeira
            $table->string('fonte')->nullable();
            $table->string('categoria')->nullable();
            $table->string('vinculacao')->nullable();
            $table->string('tipo_recurso')->nullable();

            #Planejamento estratégico
            $table->string('tipo_orcamento')->nullable();
            $table->string('perspectiva')->nullable();
            $table->string('macrodesafio')->nullable();
            $table->string('objetivo')->nullable();
            $table->string('programa')->nullable();
            $table->string('tipo_operacional')->nullable();

            #Contrado
            $table->string('numero_contrato')->nullable();
            $table->string('nome_empresa_contratada')->nullable();
            $table->string('cpf_cnpj_contratada')->nullable();
            $table->string('inicio_vigencia')->nullable();
            $table->string('termino_vigencia')->nullable();
            $table->string('valor_contrato')->nullable();

            #Valores
            $table->string('dotacao_autorizada_exercicio_anterior')->nullable();
            $table->string('dase_exercicio_anterior')->nullable();
            $table->string('reajuste')->nullable();
            $table->string('reajuste_aplicado')->nullable();
            $table->string('base_exercicio_atual')->nullable();
            $table->string('proposta_inicial')->nullable();
            $table->string('solicitado_pelo_responsavel')->nullable();
            $table->string('ajuste_setorial_pre_proposta')->nullable();
            $table->string('proposta_ajustada_limite')->nullable();
            $table->string('orcamento_aprovado')->nullable();
            $table->string('valor_mensal_maximo_autorizado')->nullable();

            #dados da importacao
            $table->string('importacao_id')->nullable();
            $table->string('despesa_id_importacao')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('despesas');
    }

}
