<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBusinessTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('businesses', function (Blueprint $table) {
            $table->increments('id');
						$table->string('name');
						$table->text('description')->nullable();
						$table->integer('ownerId')->unsigned;
						$table->string('imagePath', 255)->default('/img/default.jpg');
						$table->string('phoneNumber', 30)->nullable();
						$table->string('website', 255)->nullable();
            $table->timestamps();
						$table->foreign('ownerId')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('businesses');
    }
}
