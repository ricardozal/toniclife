<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyDistributorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('distributor', function (Blueprint $table) {
            $table->string('bank_name')->after('firebase_token')->nullable();
            $table->string('bank_account_number')->after('bank_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('distributor', function (Blueprint $table) {
            $table->dropColumn('bank_name');
            $table->dropColumn('bank_account_number');
        });
    }
}
