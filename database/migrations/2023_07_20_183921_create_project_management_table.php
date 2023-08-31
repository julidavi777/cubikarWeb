<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_managements', function (Blueprint $table) {
            $table->id();

            $table->json('gantt_schema');
            
            $table->unsignedBigInteger('commercial_offer_id');
            $table->foreign('commercial_offer_id')->references('id')->on('commercial_offers');

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
        Schema::dropIfExists('project_management');
    }
}
