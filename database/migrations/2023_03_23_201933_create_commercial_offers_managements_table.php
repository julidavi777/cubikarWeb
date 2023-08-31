<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatecommercialOffersManagementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commercial_offers_managements', function (Blueprint $table) {
            $table->id();
            
            $table->string('requirements_determination');
            $table->string('current_status');
            $table->string('requirements_verification');

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
        Schema::dropIfExists('commercial_offers_managements');
    }
}
