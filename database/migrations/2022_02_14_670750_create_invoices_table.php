<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('agency_id');

            $table->string( 'name');
        $table->date('send_date');
        $table->date('limit_date');
        $table->boolean('payed');
        $table->float('bill_amount');
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
        Schema::dropIfExists('invoices');
    }
}
