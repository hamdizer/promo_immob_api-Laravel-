<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            //->nullable();
            $table->unsignedBigInteger('agency_id');
            //->nullable();
            $table->string('name_contract');
            $table->date('send_date');
            $table->string('period');
           $table->foreign('client_id')->references('id')->on('clients')
          ->onDelete('cascade');
            $table->foreign('agency_id')->references('id')->on('agencies')
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
        Schema::dropIfExists('contracts');
    }
}
