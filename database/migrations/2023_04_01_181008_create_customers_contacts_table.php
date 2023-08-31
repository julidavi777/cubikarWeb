<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers_contacts', function (Blueprint $table) {
            //$table->id();

            $table->string('name')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('telephone_number')->nullable();
            $table->string('telephone_number_ext')->nullable();
            $table->string('email')->nullable();

            $table->unsignedBigInteger('departamento_id')->nullable();
            $table->foreign('departamento_id')
                 ->references('id')->on('departamentos')
                 ->onUpdate('cascade');
            
            $table->unsignedBigInteger('municipio_id')->nullable();
            $table->foreign('municipio_id')
                 ->references('id')->on('municipios')
                 ->onUpdate('cascade');

                 
            $table->unsignedBigInteger('customers_contact_type_id');
            $table->foreign('customers_contact_type_id')
                ->references('id')->on('customers_contact_types')
                ->onUpdate('cascade');
                 
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')
                ->references('id')->on('customers')
                ->onDelete('set null')
                ->onUpdate('cascade');
            
            //PRIMARY KEYS
            $table->primary(['customers_contact_type_id', 'customer_id']);

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
        Schema::dropIfExists('customers_contacts');
    }
}
