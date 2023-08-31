<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMunicipioDepartamentoToCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function (Blueprint $table) {
            //Add
            $table->unsignedBigInteger('departamento_id')->nullable();
            $table->foreign('departamento_id')
                 ->references('id')->on('departamentos')
                 ->onUpdate('cascade');
            
            $table->unsignedBigInteger('municipio_id')->nullable();
            $table->foreign('municipio_id')
                 ->references('id')->on('municipios')
                 ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function (Blueprint $table) {
            //
        });
    }
}
