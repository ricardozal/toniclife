<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateToniclifeSchema extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('country', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->decimal('tax_percentage');
            $table->boolean('active')->default(true);
        });

        Schema::create('address', function (Blueprint $table) {
            $table->increments('id');
            $table->string('street');
            $table->string('zip_code');
            $table->string('ext_num');
            $table->string('int_num')->nullable();
            $table->string('colony');
            $table->string('city');
            $table->string('state');
            $table->unsignedInteger('fk_id_country');
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('references')->nullable();
            $table->timestamps();

            $table->foreign('fk_id_country')
                ->references('id')
                ->on('country');
        });

        Schema::create('branch', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('active')->default(true);
            $table->unsignedInteger('fk_id_address');
            $table->timestamps();

            $table->foreign('fk_id_address')
                ->references('id')
                ->on('address');
        });

        Schema::create('user',function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->boolean('active')->default(true);
            $table->unsignedInteger('fk_id_role');
            $table->unsignedInteger('fk_id_branch')->nullable();
            $table->timestamps();

            $table->foreign('fk_id_role')
                ->references('id')
                ->on('role');

            $table->foreign('fk_id_branch')
                ->references('id')
                ->on('branch');
        });

        Schema::create('distributor', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('tonic_life_id');
            $table->string('email');
            $table->string('password');
            $table->boolean('active')->default(true);
            $table->unsignedInteger('fk_id_distributor')->nullable();
            $table->timestamps();

            $table->foreign('fk_id_distributor')
                ->references('id')
                ->on('distributor');
        });

        Schema::create('point_history', function (Blueprint $table) {
            $table->increments('id');
            $table->double('accumulated_points');
            $table->date('begin_period');
            $table->date('end_period');
            $table->unsignedInteger('fk_id_distributor')->nullable();

            $table->foreign('fk_id_distributor')
                ->references('id')
                ->on('distributor');
        });

        Schema::create('promotion', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('description');
            $table->double('min_amount');
            $table->date('begin_date');
            $table->date('expiration_date');
            $table->boolean('with_points');
            $table->boolean('is_accumulative');
            $table->boolean('active')->default(true);
            $table->unsignedInteger('fk_id_country');
            $table->timestamps();

            $table->foreign('fk_id_country')
                ->references('id')
                ->on('country');
        });

        Schema::create('distributor_has_addresses',function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('fk_id_address');
            $table->unsignedInteger('fk_id_distributor');

            $table->foreign('fk_id_address')
                ->references('id')
                ->on('address');

            $table->foreign('fk_id_distributor')
                ->references('id')
                ->on('distributor');
        });

        Schema::create('distributor_has_promotions',function (Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('fk_id_promotion');
            $table->unsignedInteger('fk_id_distributor');

            $table->foreign('fk_id_promotion')
                ->references('id')
                ->on('promotion');

            $table->foreign('fk_id_distributor')
                ->references('id')
                ->on('distributor');
        });

        Schema::create('order_status', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('payment_method', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('active')->default(true);
        });

        Schema::create('category', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->boolean('active')->default(true);
        });

        Schema::create('product', function (Blueprint $table) {
            $table->increments('id');
            $table->string('code');
            $table->string('name');
            $table->string('image_url');
            $table->double('distributor_price');
            $table->double('points');
            $table->boolean('active')->default(true);
            $table->unsignedInteger('fk_id_country');
            $table->unsignedInteger('fk_id_category')->nullable();

            $table->foreign('fk_id_country')
                ->references('id')
                ->on('country');

            $table->foreign('fk_id_category')
                ->references('id')
                ->on('category');
        });

        Schema::create('branch_has_products',function (Blueprint $table){
            $table->increments('id');
            $table->integer('stock');
            $table->unsignedInteger('fk_id_product');
            $table->unsignedInteger('fk_id_branch');
            $table->timestamps();

            $table->foreign('fk_id_product')
                ->references('id')
                ->on('product');

            $table->foreign('fk_id_branch')
                ->references('id')
                ->on('branch');
        });

        Schema::create('movement', function (Blueprint $table) {
            $table->increments('id');
            $table->longText('comment');
            $table->boolean('type');
            $table->integer('quantity');
            $table->unsignedInteger('fk_id_product');
            $table->timestamps();

            $table->foreign('fk_id_product')
                ->references('id')
                ->on('product');
        });

        Schema::create('order', function (Blueprint $table) {
            $table->increments('id');
            $table->double('total_price');
            $table->double('total_taxes');
            $table->double('total_accumulated_points');
            $table->double('shipping_price')->default(0);
            $table->boolean('bill_required')->default(false);
            $table->unsignedInteger('fk_id_distributor');
            $table->unsignedInteger('fk_id_order_status');
            $table->unsignedInteger('fk_id_shipping_address')->nullable();
            $table->unsignedInteger('fk_id_branch');
            $table->unsignedInteger('fk_id_payment_method');
            $table->timestamps();

            $table->foreign('fk_id_distributor')
                ->references('id')
                ->on('distributor');

            $table->foreign('fk_id_order_status')
                ->references('id')
                ->on('order_status');

            $table->foreign('fk_id_shipping_address')
                ->references('id')
                ->on('address');

            $table->foreign('fk_id_branch')
                ->references('id')
                ->on('branch');

            $table->foreign('fk_id_payment_method')
                ->references('id')
                ->on('payment_method');
        });

        Schema::create('order_product', function (Blueprint $table) {
            $table->increments('id');
            $table->double('price');
            $table->integer('quantity');
            $table->unsignedInteger('fk_id_product');
            $table->unsignedInteger('fk_id_order');

            $table->foreign('fk_id_product')
                ->references('id')
                ->on('product');

            $table->foreign('fk_id_order')
                ->references('id')
                ->on('order');
        });

        Schema::create('reorder_request_status', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        Schema::create('reorder_request', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('fk_id_distributor');
            $table->unsignedInteger('fk_id_reorder_request_status');
            $table->timestamps();

            $table->foreign('fk_id_distributor')
                ->references('id')
                ->on('distributor');

            $table->foreign('fk_id_reorder_request_status')
                ->references('id')
                ->on('reorder_request_status');
        });

        Schema::create('reorder_request_product', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantity');
            $table->unsignedInteger('fk_id_product');
            $table->unsignedInteger('fk_id_reorder_request');

            $table->foreign('fk_id_product')
                ->references('id')
                ->on('product');

            $table->foreign('fk_id_reorder_request')
                ->references('id')
                ->on('reorder_request');
        });

        Schema::create('new_distributor', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('email');
            $table->string('marital_status');
            $table->date('birthday');
            $table->string('birth_place');
            $table->string('nationality');
            $table->string('rfc_or_itin');
            $table->string('curp_or_ssn');
            $table->string('phone_1');
            $table->string('phone_2');
            $table->string('no_official_identification')->nullable();
            $table->unsignedInteger('fk_id_address');
            $table->unsignedInteger('fk_id_order');
            $table->timestamps();

            $table->foreign('fk_id_address')
                ->references('id')
                ->on('address');

            $table->foreign('fk_id_order')
                ->references('id')
                ->on('order');

        });

        Schema::create('data_bank', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bank_name');
            $table->string('account_name');
            $table->string('bank_account_number');
            $table->string('clabe_routing_bank');
            $table->unsignedInteger('fk_id_new_distributor');

            $table->foreign('fk_id_new_distributor')
                ->references('id')
                ->on('new_distributor');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_bank');
        Schema::dropIfExists('new_distributor');
        Schema::dropIfExists('reorder_request_product');
        Schema::dropIfExists('reorder_request');
        Schema::dropIfExists('reorder_request_status');
        Schema::dropIfExists('order_product');
        Schema::dropIfExists('order');
        Schema::dropIfExists('movement');
        Schema::dropIfExists('branch_has_products');
        Schema::dropIfExists('product');
        Schema::dropIfExists('category');
        Schema::dropIfExists('payment_method');
        Schema::dropIfExists('order_status');
        Schema::dropIfExists('distributor_has_promotions');
        Schema::dropIfExists('distributor_has_addresses');
        Schema::dropIfExists('promotion');
        Schema::dropIfExists('point_history');
        Schema::dropIfExists('distributor');
        Schema::dropIfExists('user');
        Schema::dropIfExists('branch');
        Schema::dropIfExists('address');
        Schema::dropIfExists('country');
        Schema::dropIfExists('role');
    }
}
