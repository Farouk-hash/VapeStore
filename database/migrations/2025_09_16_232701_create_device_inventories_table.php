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
        Schema::create('device_inventories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('device_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('tank_id')->nullable()->references('id')->on('tanks')->onDelete('cascade');
            $table->foreignId('coil_series_id')->nullable()->references('id')->on('coil_series')->onDelete('cascade');
            $table->foreignId('cartridge_id')->nullable()->references('id')->on('cartridge')->onDelete('cascade');

            
            // Nullable foreign keys for color and flavor
            $table->foreignId('device_color_id')->nullable()->constrained('device_colors')->onDelete('set null');
            $table->foreignId('device_flavor_id')->nullable()->constrained('device_flavors')->onDelete('set null');
            $table->foreignId('tank_color_id')->nullable()->constrained('tanks_colors')->onDelete('set null');
            $table->foreignId('coil_id')->nullable()->constrained('coils')->onDelete('set null');
            $table->foreignId('cartridge_variant_id')->nullable()->constrained('cartridge_variants')->onDelete('set null');

            // Inventory details
            $table->integer('stock_quantity')->default(0);
            $table->decimal('base_price', 10, 2);
            $table->timestamp('displayed_at');
            $table->string('barcode')->unique()->nullable();
            $table->string('batch_number')->nullable();
    
            // Status
            $table->enum('status', ['in_stock', 'low_stock', 'out_of_stock', 'discontinued'])->default('in_stock');
            
            $table->timestamps();
    
            // Unique constraint to prevent duplicate color/flavor combinations
            $table->unique(
                ['device_id', 'device_color_id', 'device_flavor_id'],
                'unique_device_color_flavor'
            );
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('device_inventories');
    }
};
