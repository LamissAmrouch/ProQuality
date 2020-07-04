<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcedesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('procedes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('designation');
            $table->string('description')->nullable();
            $table->unsignedBigInteger('produit_id')->nullable(); 
            $table->unsignedBigInteger('atelier_id')->nullable(); 
            $table->foreign('produit_id')
            ->references('id')->on('produits')
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
        Schema::dropIfExists('procedes');
    }
}
