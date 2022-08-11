<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('branches', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique()->nullable(false);
            $table->unsignedBigInteger('region_id');
            $table->unsignedBigInteger('address_id')->unique();
            $table->timestamps();

            $table->foreign('address_id')
                ->references('id')
                ->on('addresses')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();

            $table->foreign('region_id')
                ->references('id')
                ->on('regions')
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
        Schema::dropIfExists('branches');
    }
}
