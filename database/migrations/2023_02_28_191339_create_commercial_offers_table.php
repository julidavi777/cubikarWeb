<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommercialOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commercial_offers', function (Blueprint $table) {
            $table->id();

            $table->string('sequential_number')->unique();
            $table->string('contract_type');
            $table->string('contract_type_other')->nullable();
            $table->string('service_type');
            $table->string('service_type_other')->nullable();
            $table->string('sector_productivo');
            $table->string('sector_productivo_other')->nullable();
            $table->text('object_description');
            $table->string('numero')->nullable();
            $table->bigInteger('cuantia')->nullable();
            $table->string('location');
            $table->date('release_date');
            $table->date('delivery_date');
            //$table->date('visit_date');
            $table->text('observations')->nullable();

            $table->json('anexos')->nullable();

            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('responsable_id');
            //$table->unsignedBigInteger('responsable_id')->nullable();

            $table->foreign('customer_id')
                 ->references('id')->on('customers')
                 ->onDelete('set null')
                 ->onUpdate('cascade');

            $table->foreign('responsable_id')
                 ->references('id')->on('users')
                 ->onDelete('set null')
                 ->onUpdate('cascade');

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
        Schema::dropIfExists('commercial_offers');
    }
}
