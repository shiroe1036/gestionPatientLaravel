<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoriqueLogDossiersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historique_log_dossiers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('dossier_patient_id')->unsigned();
            $table->foreign('dossier_patient_id')->references('id')
                ->on('dossier_patients')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')
                ->on('users')
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
        Schema::table('historique_log_dossiers', function(Blueprint $table){
            $table->dropForeign('historique_log_dossiers_user_id_foreign');
            $table->dropColumn('user_id');
            $table->dropForeign('historique_log_dossiers_dossier_patient_id_foreign');
            $table->dropColumn('dossier_patient_id');
        });
        
        Schema::dropIfExists('historique_log_dossiers');
    }
}
