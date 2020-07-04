<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('examens', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom')->unique();
            $table->string('type');
            $table->BigInteger('min')->nullable(); 
            $table->BigInteger('max')->nullable();  
            $table->string('unite')->nullable();   
            /*$table->string('reponse1')->nullable(); 
            $table->string('reponse2')->nullable(); */
        
            $table->unsignedBigInteger('test_id')->nullable();
            $table->foreign('test_id')
            ->references('id')->on('tests')
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
        Schema::dropIfExists('examens');
    }
}
