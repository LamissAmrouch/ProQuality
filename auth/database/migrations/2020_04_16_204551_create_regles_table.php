<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReglesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regles', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titre');
            $table->string('contenu');
            $table->enum('etat', ['brouillon','validé'])->default('brouillon');
            $table->unsignedBigInteger('user_id'); //executive user
            $table->unsignedBigInteger('produit_id');
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
        Schema::dropIfExists('regles');
    }


}
