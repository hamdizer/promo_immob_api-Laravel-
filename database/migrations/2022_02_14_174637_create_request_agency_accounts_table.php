<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestAgencyAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('request_agency_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('admin_id');
            $table->unsignedBigInteger('agency_id');
            $table->date('send_date');
            $table->tinyInteger('state');
            $table->foreign('agency_id')->references('id')->on('agencies')
                ->onDelete('Cascade');
            $table->foreign('admin_id')->references('id')->on('administrators')
                ->onDelete('Cascade');

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
        Schema::dropIfExists('request_agency_accounts');
    }
}
