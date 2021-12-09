<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id')->unique('orders_id_uindex');
            $table->char('number', 8)->unique('orders_number_uindex');
            $table->unsignedBigInteger('user_id')->nullable()->index('orders_users_id_fk');
            $table->unsignedBigInteger('organization_id')->nullable()->index('orders_organizations_id_fk');
            $table->dateTime('create_at')->useCurrent();
            $table->dateTime('update_at')->useCurrent();
            $table->enum('status', ['processing', 'confirmed', 'transit', 'canceled', 'completed']);
            $table->boolean('is_paid')->nullable();
            $table->integer('sum')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
