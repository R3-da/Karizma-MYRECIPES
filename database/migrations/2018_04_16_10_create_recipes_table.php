<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id'); // Assuming association with a user
            $table->string('name');
            $table->text('ingredients'); // Changed to text for storing multiple ingredients
            $table->text('instructions'); // Changed to text for storing detailed instructions
            $table->integer('duration'); // Changed to integer for duration in minutes
            $table->string('status')->default('active'); // If 'status' is needed

            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users'); // Assuming users table for user associations
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recipes');
    }
}
