<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApuActivitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apu_activities', function (Blueprint $table) {
            $table->id();
            $table->double('cap');
            $table->text('description');
            $table->string('unit');
            $table->integer('quantity');
            $table->bigInteger('unit_value');
            $table->boolean('status')->default(true);
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('chapter_id');
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('customers');
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
        Schema::dropIfExists('apu_activites');
    }
}
