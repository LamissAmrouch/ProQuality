<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttributsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attributs', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nom');
            $table->text('description');
            $table->unsignedBigInteger('anomalie_id')->nullable();
            $table->unsignedBigInteger('audit_id')->nullable();
            $table->unsignedBigInteger('inspection_id')->nullable();
            $table->unsignedBigInteger('action_id')->nullable();
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
        Schema::dropIfExists('attributs');
    }
}
