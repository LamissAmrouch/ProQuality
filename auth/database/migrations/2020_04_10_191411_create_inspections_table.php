<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInspectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('titre');
            $table->integer('step')->default(1);
            $table->enum('etat', ['nouveau','en cours','traité'])->default('nouveau');
            $table->text('resultats')->nullable();
            $table->text('commentaire')->nullable();
            $table->string('productimg')->nullable();
            $table->text('description')->nullable(); 
            $table->integer('quantiteD')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('test_id')->nullable();
            $table->unsignedBigInteger('lot_id')->nullable();
            $table->unsignedBigInteger('anomalie_id')->nullable();
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
        Schema::dropIfExists('inspections');
    }
}
