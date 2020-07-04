<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnomalieRegleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('anomalie_regle', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('anomalie_id');
            $table->unsignedBigInteger('regle_id');
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
        Schema::dropIfExists('anomalie_regle');
    }
}
