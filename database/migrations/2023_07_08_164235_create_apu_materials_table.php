<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApuMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apu_materials', function (Blueprint $table) {
            $table->id();
            $table->string('code')->nullable();
            $table->text('description');
            $table->string('unit')->nullable();
            $table->bigInteger('unit_value');
            $table->text('reference_link')->nullable();
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
        Schema::dropIfExists('apu_materials');
    }
}
