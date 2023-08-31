<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommercialOffersSeguimientoFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commercial_offers_seguimiento_files', function (Blueprint $table) {
            $table->id();

            $table->json('file');
            $table->boolean('status')->default('false');

            $table->unsignedBigInteger('commercial_offers_seguimiento_id');

            $table->foreign('commercial_offers_seguimiento_id')
                    ->references('id')->on('commercial_offers_seguimientos')
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
        Schema::dropIfExists('commercial_offers_seguimiento_files');
    }
}
