<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAlertsMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alerts', function (Blueprint $table) {
            $table->unsignedBigInteger('anomalie_id')->nullable(); 
            $table->unsignedBigInteger('event_id')->nullable(); 

            $table->foreign('anomalie_id')
            ->references('id')->on('anomalies')
            ->onDelete('cascade');

            $table->foreign('event_id')
            ->references('id')->on('events')
            ->onDelete('cascade');
        });
        Schema::table('events', function (Blueprint $table) {
            $table->unsignedBigInteger('inspection_id')->nullable(); 
            $table->unsignedBigInteger('audit_id')->nullable();

            $table->foreign('inspection_id')
            ->references('id')->on('inspections')
            ->onDelete('cascade');

            $table->foreign('audit_id')
            ->references('id')->on('audits')
            ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {   
        Schema::table('events', function (Blueprint $table) {
            $table->dropForeign('events_audit_id_foreign');
            $table->dropColumn('audit_id');
            $table->dropForeign('events_inspection_id_foreign');
            $table->dropColumn('inspection_id');
        });
        Schema::table('alerts', function (Blueprint $table) {
            $table->dropForeign('alerts_event_id_foreign');
            $table->dropColumn('event_id');
            $table->dropForeign('alerts_anomalie_id_foreign');
            $table->dropColumn('anomalie_id');
        });
    }
}
