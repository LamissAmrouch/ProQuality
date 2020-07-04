<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFichiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fichiers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom');
            $table->string('type');
            $table->string('url',6000);
            $table->unsignedBigInteger('user_id')->nullable(); // the one who uploaded it or the user's avatar
            $table->unsignedBigInteger('anomalie_id')->nullable(); 
            $table->unsignedBigInteger('produit_id')->nullable(); 
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
        Schema::dropIfExists('fichiers');
    }
}
