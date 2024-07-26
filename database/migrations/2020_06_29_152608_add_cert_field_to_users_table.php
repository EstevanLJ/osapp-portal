<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCertFieldToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->text('private_key')->nullable()->after('type');
            $table->text('certificate')->nullable()->after('private_key');
            $table->text('private_key_password')->nullable()->after('certificate');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('private_key');
            $table->dropColumn('certificate');
            $table->dropColumn('private_key_password');
        });
    }
}
