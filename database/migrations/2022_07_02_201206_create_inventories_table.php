<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInventoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('quantity')->nullable(false);
            $table->unsignedBigInteger('station_id');
            $table->unsignedBigInteger('category_id');
            $table->timestamps();

            $table->foreign('station_id')
                ->references('id')
                ->on('stations')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inventories');
    }
}
