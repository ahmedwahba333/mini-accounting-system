<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade')->onUpdate('cascade');
            $table->date('sale_date');
            $table->string('ref_number');
            $table->integer('discount')->nullable();
            $table->integer('tax')->nullable();
            $table->integer('quantity_items');
            $table->string('shipping_address');
            $table->integer('shipping_price');
            $table->integer('total_amount');
            $table->text('note')->nullable();
            $table->enum('status', ['finished', 'pending', 'rejected']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
