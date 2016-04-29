<?php
/**
* @author Elias D. Peraza @tes1oner
*/
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTActiRecusTable extends Migration
{
    public function up(){
        Schema::table('t_acti_recus', function (Blueprint $table){
            $table->date('fecIni');
            $table->date('ultLan')->nullable();
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(){
        //Schema::drop('t_acti_recus');
    }
}
//2016_04_18_012258
