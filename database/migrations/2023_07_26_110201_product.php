<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Product extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product', function (Blueprint $table) {
            $table->unsignedInteger('id')->autoIncrement();
            $table->string('product_name'); // Added the product_name field
            $table->decimal('unit_price', 10, 2); // Assuming the price will be stored as decimal(10, 2)
            $table->integer('quantity');
            $table->unsignedInteger('invoice_id'); // Foreign key column for the invoice
            $table->timestamps();

            // Define foreign key constraint for invoice_id referencing the invoices table
            $table->foreign('invoice_id')->references('id')->on('invoice');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('product');
    }
}
