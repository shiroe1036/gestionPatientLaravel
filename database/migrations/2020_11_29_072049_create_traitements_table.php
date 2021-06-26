<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTraitementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('traitements', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('medicament_id')->unsigned();
            $table->integer('maladie_id')->unsigned();
            $table->foreign('user_id')->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('medicament_id')->references('id')
                ->on('medicaments')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->foreign('maladie_id')->references('id')
                ->on('maladies')
                ->onDelete('cascade')
                ->onUpdatet('cascade');
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
        Schema::table('traitements', function(Blueprint $table){
            $table->dropForeign('traitements_user_id_foreign');
            $table->dropForeign('traitements_medicament_id_foreign');
            $table->dropForeign('traitements_maladie_id_foreign');
        });
        
        Schema::dropIfExists('traitements');
    }
}
