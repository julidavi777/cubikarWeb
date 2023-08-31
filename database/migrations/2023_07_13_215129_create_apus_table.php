<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apus', function (Blueprint $table) {
            $table->id();
            $table->json('schema');
            
            $table->unsignedBigInteger('apu_activity_id');
            $table->timestamps();
            $table->foreign('apu_activity_id')->references('id')->on('apu_activities');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('apus');
    }
}
