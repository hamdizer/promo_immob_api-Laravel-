<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestClientAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_client_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id')->unsigned()->index();
            $table->unsignedBigInteger('client_id')->unsigned()->index();
            $table->date('send_date');
            $table->tinyInteger('state');
            $table->foreign('admin_id')->references('id')->on('administrators')
                ->onDelete('Cascade');
            $table->foreign('client_id')->references('id')->on('clients')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_client_accounts');
    }
}
