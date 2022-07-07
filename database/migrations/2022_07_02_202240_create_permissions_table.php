<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(false);
            $table->unsignedInteger('invoice_add')->default(0)->nullable(false);
            $table->unsignedInteger('invoice_manage')->default(0)->nullable(false);
            $table->unsignedInteger('inventory_manage')->default(0)->nullable(false);
            $table->unsignedInteger('category_manage')->default(0)->nullable(false);
            $table->unsignedInteger('station_manage')->default(0)->nullable(false);
            $table->unsignedInteger('operation_manage')->default(0)->nullable(false);
            $table->unsignedInteger('user_manage')->default(0)->nullable(false);
            $table->unsignedInteger('permission_mange')->default(0)->nullable(false);
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
        Schema::dropIfExists('permissions');
    }
}
