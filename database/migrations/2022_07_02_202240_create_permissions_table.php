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
            $table->unsignedInteger('invoice_add')->default(0)->nullable(false);
            $table->unsignedInteger('InvoiceManage')->default(0)->nullable(false);
            $table->unsignedInteger('InventoryManage')->default(0)->nullable(false);
            $table->unsignedInteger('CategoryManage')->default(0)->nullable(false);
            $table->unsignedInteger('StationManage')->default(0)->nullable(false);
            $table->unsignedInteger('OperationManage')->default(0)->nullable(false);
            $table->unsignedInteger('UserManage')->default(0)->nullable(false);
            $table->unsignedInteger('PermissionMange')->default(0)->nullable(false);
            $table->unsignedBigInteger('user_id');
            $table->timestamps();


            $table->foreign('user_id')
                ->references('id')
                ->on('users')
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
        Schema::dropIfExists('permissions');
    }
}
