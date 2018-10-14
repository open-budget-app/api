<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepeatTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('repeat_types', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('budget_id');
            $table->timestamps();

            $table->foreign('budget_id')->references('id')->on('budgets');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('repeat_types');
    }
}
