<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFormFotoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_foto', function (Blueprint $table) {
            $table->id();
            
            $table->unsignedBigInteger('form_id');
            $table->foreign('form_id')->references('id')->on('form');
            
            $table->text('carimbo_tempo')->nullable();

            $table->string('descricao');
            $table->string('caminho_foto');
            $table->jsonb('geolocalizacao')->nullable();
            $table->jsonb('exif')->nullable();

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
        Schema::dropIfExists('form_foto');
    }
}
