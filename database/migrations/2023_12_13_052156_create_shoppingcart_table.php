<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShoppingCartTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('shopping_cart', function (Blueprint $table) {
            $table->string('identifier',80);
            $table->string('instance',80);
            $table->longText('content');
            $table->nullableTimestamps();

            $table->primary(['identifier', 'instance']);
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('shopping_cart');
    }
}
