<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('work_posts', function (Blueprint $table) {
            $table->id();
            $table->date('joining_date')->nullable(false);
            $table->date('leave_date')->nullable();
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
        Schema::dropIfExists('work_posts');
    }
}
