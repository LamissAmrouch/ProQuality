<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnomaliesTable extends Migration
{

    public function up()
    {
        Schema::create('anomalies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('titre')->nullable();
            $table->text('description')->nullable();
            $table->string('type')->nullable();
            $table->double('amount', 8, 2)->nullable();	
            $table->enum('etat', ['nouveau','en cours','traité'])->default('nouveau');
            $table->integer('step')->default(1);

            $table->string('criticite')->nullable();
            $table->text('cause')->nullable();
            $table->text('diagnostique')->nullable();
            
            $table->text('resultats')->nullable();
            $table->string('action')->nullable(); // to be changed with table (action_anomalie)

            /* one to many */
            $table->string('productimg')->nullable(); // used temporary after will use (fichier table)

            $table->unsignedBigInteger('lot_id'); // required            
            $table->unsignedBigInteger('reparateur_id')->nullable();
            $table->unsignedBigInteger('test_id')->nullable();

            $table->unsignedBigInteger('atelier_id')->nullable(); 
            $table->unsignedBigInteger('fournisseur_id')->nullable(); 
            $table->unsignedBigInteger('client_id')->nullable(); 
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
        Schema::dropIfExists('anomalies');
    }


}
