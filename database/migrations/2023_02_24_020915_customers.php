<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Customers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();

            $table->integer('identification_type');
            $table->string('identification')->unique();
            $table->string('digit_v')->nullable();
            $table->string('name');
            $table->string('surname');
            $table->string('phone_number');
            $table->string('address');
            $table->string('email');
            $table->string('nombre_contacto_comercial');
            $table->string('commercial_contact_1');
            $table->string('commercial_contact_2')->nullable();
            $table->string('commercial_contact_3')->nullable();
            $table->string('razon_social');
            $table->string('razon_comercial');
            
            $table->json('rut_file')->nullable();
            $table->json('camara_commerce_file')->nullable();
            $table->json('income_statement_file')->nullable();
            $table->json('cliente_logo')->nullable();

            $table->boolean('status')->default('1');
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
        Schema::dropIfExists('customers');
    }
}
