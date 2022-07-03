<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryInvoiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_invoice', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('invoice_id');
            $table->timestamps();

            $table->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->cascadeOnDelete()
                ->cascadeOnUpdate();
            $table->foreign('invoice_id')
                ->references('id')
                ->on('invoices')
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
        Schema::dropIfExists('category_invoices');
    }
}
