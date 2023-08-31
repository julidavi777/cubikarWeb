<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApuLaborPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apu_labor_prices', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->string('unit');
            $table->bigInteger('unit_price_eje_value')->nullable();
            $table->bigInteger('unit_price_bogota_value')->nullable();
            $table->bigInteger('unit_price_medellin_value')->nullable();
            $table->boolean('status')->default(true);
            $table->unsignedBigInteger('chapter_id');
            $table->timestamps();

            $table->foreign('chapter_id')->references('id')->on('chapters');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apu_labor_analysis_items');
    }
}
