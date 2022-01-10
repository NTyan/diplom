<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->char('name');
            $table->enum('type', ['ip', 'jur']);
            $table->char('jur_address')->nullable();
            $table->char('inn', 12)->nullable();
            $table->char('kpp', 9)->nullable();
            $table->char('ogrn', 13)->nullable();
            $table->char('payment_account', 20)->nullable();
            $table->unsignedBigInteger('user_id')->index('organizations_users_id_fk');
            $table->softDeletes();
            $table->text('description')->nullable();
            $table->char('email', 25)->nullable();
            $table->char('phone_number', 12)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organizations');
    }
}
