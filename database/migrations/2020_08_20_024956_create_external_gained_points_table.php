<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExternalGainedPointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('external_gained_points', function (Blueprint $table) {
            $table->increments('id');
            $table->double('points')->nullable();
            $table->double('money')->nullable();
            $table->unsignedInteger('fk_id_point_history');
            $table->unsignedInteger('fk_id_order')->nullable();
            $table->timestamps();

            $table->foreign('fk_id_order')
                ->references('id')
                ->on('order');

            $table->foreign('fk_id_point_history')
                ->references('id')
                ->on('point_history');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('external_gained_points');
    }
}
