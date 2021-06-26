<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateTraitementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('traitements', function (Blueprint $table) {
            $table->integer('maladie_id')->unsigned()->nullable()->change();
            $table->integer('dossier_patient_id')->unsigned();
            $table->foreign('dossier_patient_id')->references('id')
                ->on('dossier_patients')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('traitements', function (Blueprint $table) {
            //
        });
    }
}
