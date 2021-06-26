<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDossierPatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dossier_patients', function (Blueprint $table) {
            $table->increments('id');
            $table->text('observation');
            $table->date('dateDebut');
            $table->date('dateFin')->nullable();
            $table->text('analyseBacteriologique');
            $table->text('analyseChimique');
            $table->integer('patient_id')->unsigned();
            $table->foreign('patient_id')->references('id')
                ->on('patients')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->timestamps();
            $table->engine = 'InnoDB';
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dossier_patients', function(Blueprint $table){
            $table->dropForeign('dossier_patients_patient_id_foreign');
        });
        
        Schema::dropIfExists('dossier_patients');
    }
}
