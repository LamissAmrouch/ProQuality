<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reponses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('valeur');
            $table->string('etat');
            $table->unsignedBigInteger('examen_id');
            $table->unsignedBigInteger('inspection_id')->nullable();  
            $table->unsignedBigInteger('anomalie_id')->nullable();
            
            $table->foreign('examen_id')
            ->references('id')->on('examens')
            ->onDelete('cascade');   
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
        Schema::dropIfExists('reponses');
    }
}
