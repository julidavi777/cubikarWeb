<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommercialOffersVisitsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commercial_offers_visits', function (Blueprint $table) {
            $table->id();

            $table->date('visit_date')->nullable();
            $table->string('visit_place')->nullable();
            $table->string('person_attending')->nullable();
            $table->string('phone_number_person_attending')->nullable();

            $table->unsignedBigInteger('commercial_offer_id')->unique();

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
        Schema::dropIfExists('commercial_offers_visits');
    }
}
