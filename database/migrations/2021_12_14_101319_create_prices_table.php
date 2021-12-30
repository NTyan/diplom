<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prices', function (Blueprint $table) {
            $table->integer('id', true);
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->enum('plastic', ['ABS', 'PLA', 'TPU', 'Neylon', 'PETG', 'FLEX'])->nullable();
            $table->integer('price')->nullable();

            $table->unique(['organization_id', 'plastic'], 'prices_pk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('prices');
    }
}
