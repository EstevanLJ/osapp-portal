<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNumeroOsFieldToFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('form', function (Blueprint $table) {
            $table->string('numero_os')->nullable()->after('descricao_atividade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('form', function (Blueprint $table) {
            $table->dropColumn('numero_os');
        });
    }
}
