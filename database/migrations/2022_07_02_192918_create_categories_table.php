<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->nullable(false);
            $table->string('details')->nullable(false);
            $table->unsignedInteger('size')->nullable(false);
            $table->unsignedDouble('cost_price')->nullable(false);
            $table->unsignedDouble('sell_price')->nullable(false);
            $table->unsignedDouble('discount')->default(0)->nullable(false);
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
        Schema::dropIfExists('categories');
    }
}
