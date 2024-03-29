<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('verified')->default(0)->nullable(false);
            $table->integer('verify_email')->default(-1)->nullable(false);
            $table->string('username')->unique()->nullable(false);
            $table->integer('type')->default(-1)->nullable(false);
            $table->unsignedInteger('status')->default(0)->nullable(false);
            $table->string('name')->nullable(false);
            $table->string('email')->unique()->nullable(false);
            $table->string('password')->nullable(false);
            $table->unsignedDouble('salary')->nullable();
            $table->date('hire_date')->nullable();
            $table->string('avatar')->nullable();
            $table->unsignedBigInteger('address_id')->unique();
            $table->unsignedBigInteger('region_id')->nullable();
            $table->unsignedBigInteger('branch_id')->nullable();
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

            $table->foreign('branch_id')
                ->references('id')
                ->on('branches')
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
        Schema::dropIfExists('users');
    }
}
