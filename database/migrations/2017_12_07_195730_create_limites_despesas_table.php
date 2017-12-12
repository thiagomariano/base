<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLimitesDespesasTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('limites_despesas', function(Blueprint $table) {
            $table->increments('id');
            $table->string('ano')->nullable();
            $table->string('momento_planejamento')->nullable();
            $table->string('ug')->nullable();
            $table->string('descricao_regra')->nullable();
            $table->string('valor_limite')->nullable();
            $table->string('carater_despesa')->nullable();
            $table->string('ptres')->nullable();
            $table->string('natureza_despesa')->nullable();
            $table->string('data_hora')->nullable();
            $table->string('autor')->nullable();
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
		Schema::drop('limites_despesas');
	}

}
