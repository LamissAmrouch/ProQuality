<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlertsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('alerts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('sent')->default(0);
            $table->enum('etat', ['nouveau','en cours', 'traité'])->nullable();

            $table->enum('type', ['Rappel','Retour fournisseur', 'Retour client', 'Retour production']);
            $table->text('description')->nullable();
            $table->text('motif')->nullable();
            $table->date('start')->nullable(); //for calendar

            $table->unsignedBigInteger('lot_id')->nullable();
            $table->unsignedBigInteger('client_id')->nullable();
            $table->unsignedBigInteger('fournisseur_id')->nullable();
            $table->unsignedBigInteger('atelier_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable(); /* receiver of the alert */
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
        Schema::dropIfExists('alerts');
    }
}
