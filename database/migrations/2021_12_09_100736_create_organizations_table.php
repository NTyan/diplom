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
            $table->bigIncrements('id')->unique('organizations_id_uindex');
            $table->char('name');
            $table->enum('type', ['ip', 'jur']);
            $table->char('jur_address')->nullable();
            $table->char('inn', 12)->nullable();
            $table->char('kpp', 9)->nullable();
            $table->char('ogrn', 13)->nullable();
            $table->char('payment_account', 20)->nullable();
            $table->unsignedBigInteger('user_id')->index('organizations_users_id_fk');
            $table->softDeletes();
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
