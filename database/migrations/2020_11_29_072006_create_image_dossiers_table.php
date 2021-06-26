<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImageDossiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('image_dossiers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('radio', 255)->nullable();
            $table->string('scanner', 255)->nullable();
            $table->text('interpretation');
            $table->integer('dossier_patient_id')->unsigned();
            $table->foreign('dossier_patient_id')->references('id')
                ->on('dossier_patients')
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
        Schema::table('image_dossiers', function(Blueprint $table){
            $table->dropForeign('image_dossiers_dossier_patient_id_foreign');
            $table->dropColumn('dossier_patient_id');
        });
        
        Schema::dropIfExists('image_dossiers');
    }
}
