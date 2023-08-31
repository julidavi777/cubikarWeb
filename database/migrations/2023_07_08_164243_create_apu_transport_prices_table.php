<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApuTransportPricesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apu_transport_prices', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->string('unit');
            $table->bigInteger('unit_price_eje_value')->nullable();
            $table->bigInteger('unit_price_bogota_value')->nullable();
            $table->bigInteger('unit_price_medellin_value')->nullable();
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('apu_transport_prices');
    }
}
