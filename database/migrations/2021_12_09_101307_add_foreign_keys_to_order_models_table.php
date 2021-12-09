<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToOrderModelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('order_models', function (Blueprint $table) {
            $table->foreign(['order_id'], 'order_models_orders_id_fk')->references(['id'])->on('orders');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('order_models', function (Blueprint $table) {
            $table->dropForeign('order_models_orders_id_fk');
        });
    }
}
