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
        Schema::create('bills', function (Blueprint $table) {
            $table->id('id');
            $table->decimal('total_price', 10, 2);
            $table->boolean('has_discount')->default(false);
            $table->decimal('discount_value', 10, 2)->default(0);
            $table->decimal('total_after_discount', 10, 2);
            $table->foreignId('customer_id')->nullable()->references('id')->on('customers')->nullOnDelete();

            $table->nullableMorphs('created_by'); // CREATED_BY ID , CREATED_BY_TYPE[ADMIN , SALES-PERSON] ; 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills');
    }
};
