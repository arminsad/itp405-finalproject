<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToFoodIngredientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('food_ingredient', function (Blueprint $table) {
            $table->foreignId('user_id')->nullable()->default(1)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('food_ingredient', function (Blueprint $table) {
            Schema::dropColumns('food_ingredient', ['user_id']);
        });
    }
}
