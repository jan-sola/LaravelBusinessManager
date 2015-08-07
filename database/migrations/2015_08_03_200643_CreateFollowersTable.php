<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFollowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('followers', function(Blueprint $table){
					$table->integer('userId')->unsigned();
					$table->integer('businessId')->unsigned();
          $table->timestamps();
					$table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
					$table->foreign('businessId')->references('id')->on('businesses')->onDelete('cascade');
				});
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('followers');
    }
}
