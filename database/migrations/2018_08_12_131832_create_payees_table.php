<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();

            $table->unsignedInteger('account_id')->nullable();
            $table->foreign('account_id')->references('id')->on('accounts');

            $table->unsignedInteger('budget_id');
            $table->foreign('budget_id')->references('id')->on('budgets');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payees');
    }
}
