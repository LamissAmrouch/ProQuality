<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('audits', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('titre');
            $table->text('description')->nullable(); 

            $table->integer('step')->default(1);
            $table->enum('etat', ['nouveau','en cours','traité'])->default('nouveau');
            
            $table->text('resultats')->nullable();
            $table->text('commentaire')->nullable();
            $table->string('productimg')->nullable();
            $table->unsignedBigInteger('user_id')->nullable(); 
            $table->unsignedBigInteger('atelier_id')->nullable();
            $table->unsignedBigInteger('procede_id')->nullable();
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
        Schema::dropIfExists('audits');
    }
}
