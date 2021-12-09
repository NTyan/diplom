<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_models', function (Blueprint $table) {
            $table->increments('id')->unique('order_models_id_uindex');
            $table->integer('width')->nullable();
            $table->integer('height')->nullable();
            $table->integer('volume')->nullable();
            $table->integer('weight')->nullable();
            $table->char('color', 6)->nullable();
            $table->enum('plastic', ['ABS', 'PLA', 'TPU', 'Neylon', 'PETG', 'FLEX'])->nullable();
            $table->unsignedBigInteger('order_id')->nullable()->index('order_models_orders_id_fk');
            $table->integer('count')->nullable();
            $table->integer('price')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_models');
    }
}
