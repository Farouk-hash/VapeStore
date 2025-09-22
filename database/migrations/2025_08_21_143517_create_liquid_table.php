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
 
        Schema::create('liquid', function (Blueprint $table) {
            $table->id();
            $table->string('nicotine_type');
            $table->string('vape_style' , );
            $table->string('vg_pg_ratio');
            $table->integer('bottle_size_ml');
            $table->foreignId('flavour_id')->references('id')->on('flavour')->cascadeOnDelete()->cascadeOnUpdate();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('liquid');
    }
};
