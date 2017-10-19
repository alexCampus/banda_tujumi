<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UserEvent extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event_model_user', function(Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('event_model_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users_banda_tujumi')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');

            $table->foreign('event_model_id')->references('id')->on('event_models')
                        ->onDelete('restrict')
                        ->onUpdate('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('event_model_user', function(Blueprint $table) {
            $table->dropForeign('event_model_user_user_id_foreign');
            $table->dropForeign('event_model_user_event_model_id_foreign');
        });

        Schema::drop('event_model_user');
    }
}
