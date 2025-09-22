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
        Schema::create('bills_notes', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('notes');
            $table->enum('priority',['low','medium','high']);
            $table->foreignId('bill_id')->references('id')->on('bills')->cascadeOnDelete();
            $table->foreignId('admin_id')->references('id')->on('admins');
            $table->boolean('read')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bills_notes');
    }
};
