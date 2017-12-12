<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegrasGeraisTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('regras_gerais', function(Blueprint $table) {
            $table->increments('id');
            $table->string('ano')->nullable();
            $table->string('momento_planejamento')->nullable();
            $table->string('descricao_regra')->nullable();
            $table->string('percentual_ajuste')->nullable();
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
		Schema::drop('regras_gerais');
	}

}
