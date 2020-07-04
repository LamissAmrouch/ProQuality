<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCaracteristiquesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('caracteristiques', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom');
            $table->unsignedBigInteger('produit_id');
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
        Schema::dropIfExists('caracteristiques');
    }
}
