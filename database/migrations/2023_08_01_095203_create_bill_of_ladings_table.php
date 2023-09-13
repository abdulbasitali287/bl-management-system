<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill_of_ladings', function (Blueprint $table) {
            $table->id('bid');
            $table->string('aesl_no')->unique();
            $table->string('idbn_no')->unique();
            $table->string('bl_no',100)->unique()->nullable();
            $table->unsignedBigInteger('shipper_id');
            // $table->string('consignee')->default('Allied');
            // $table->unsignedBigInteger('vessel_id');
            // $table->string('voyage_number',100)->nullable();
            $table->string('port_of_loading')->default('dubai port');
            $table->string('port_of_discharge')->default('port qasim');
            // $table->string('place_of_receipt',100);
            // $table->string('place_of_delivery',100);
            $table->decimal('freight_chr')->nullable()->default(0.00);
            $table->date('arrival_date')->nullable();
            // $table->date('delivery_date')->nullable();
            // $table->string('container_no')->nullable();
            $table->decimal('gross_weight')->nullable();
            $table->integer('pkg_count')->nullable();
            $table->unsignedBigInteger('user_id');
            $table->boolean('status')->default(1);
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('shipper_id')->references('shipper_id')->on('shippers')->onUpdate('cascade')->onDelete('cascade');
            // $table->foreign('vessel_id')->references('ship_id')->on('shipping_lines')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bill_of_ladings');
    }
};
