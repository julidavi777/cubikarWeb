<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommercialOffersSeguimientosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commercial_offers_seguimientos', function (Blueprint $table) {
            $table->id();

            $table->string('status');
            $table->text('description');


            $table->unsignedBigInteger('commercial_offer_id');
            $table->foreign('commercial_offer_id')
                 ->references('id')->on('commercial_offers')
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
        Schema::dropIfExists('commercial_offers_seguimientos');
    }
}
