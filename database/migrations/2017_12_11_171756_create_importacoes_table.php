<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImportacoesTable extends Migration
{

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('importacoes', function(Blueprint $table) {
            $table->increments('id');
            $table->string('descricao')->nullable();
            $table->string('ano')->nullable();
            $table->string('autor')->nullable();
            $table->string('quantidade_itens')->nullable();
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
		Schema::drop('importacoes');
	}

}
