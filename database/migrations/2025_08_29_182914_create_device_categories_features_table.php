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
        Schema::create('device_categories_features', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained('device_categories')->onDelete('cascade');
            $table->string('feature_key'); // e.g., 'is_reusable', 'has_flavors', 'has_colors'
            $table->string('feature_value'); // e.g., 'true', 'false', 'optional'
            $table->text('description')->nullable();            
            $table->unique(['category_id', 'feature_key']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_categories_features');
    }
};
