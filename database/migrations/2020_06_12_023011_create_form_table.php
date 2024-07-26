<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('users');

            $table->string('status');
            $table->text('status_message')->nullable();
            
            $table->string('device_id');

            $table->date('data_atividade');
            $table->time('hora_inicio');
            $table->time('hora_fim');
            $table->string('descricao_atividade');

            $table->text('avaliacao_riscos');
            $table->text('medidas_controle');

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
        Schema::dropIfExists('form');
    }
}
