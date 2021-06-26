<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUrgencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('urgences', function (Blueprint $table) {
            $table->increments('id');
            $table->date('dateAdmission');
            $table->text('motifAdmission');
            $table->date('dateSortieUrgence')->nullable();
            $table->text('motifSortieUrgence')->nullable();
            $table->date('dateSortieHopital')->nullable();
            $table->text('motifSortieHopital')->nullable();
            $table->date('dateDece')->nullable();
            $table->text('motifDece')->nullable();
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
        Schema::table('urgences', function(Blueprint $table){
            $table->dropForeign('urgences_patient_id_foreign');
        });
        
        Schema::dropIfExists('urgences');
    }
}
