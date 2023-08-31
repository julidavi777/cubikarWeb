<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('surname')->nullable();
            $table->string('id_card')->nullable();
            $table->enum('type_id',['CC','CE','PPORT'])->nullable();
            $table->string('address')->nullable();
            $table->string('position')->nullable(); 
            $table->bigInteger('phone')->unique();
            $table->string('email')->unique();
            $table->string('cv_file')->nullable();
            $table->string('medical_exam_file')->nullable();
            $table->string('followup_letter_file')->nullable();
            $table->string('history_file')->nullable();
            $table->string('study_stands_file')->nullable();
            $table->string('id_card_file')->nullable();
            $table->string('work_certificate_file')->nullable();
            $table->string('military_passbook_file')->nullable();
            $table->date('exam_expiration')->nullable();
            $table->date('contract_expiration')->nullable();
            
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
        Schema::dropIfExists('employees');
    }
}
