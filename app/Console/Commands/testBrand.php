<?php

namespace App\Console\Commands;

use App\Models\CommonModels\Brand;
use Illuminate\Console\Command;

class testBrand extends Command
{
   /**
     * The name and signature of the console command.
     *
     * Example: php artisan test:brand
     */
    protected $signature = 'test:brand';

    /**
     * The console command description.
     */
    protected $description = 'Test the Brand model scopes and relations';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        // Test all brands
        $this->info("=== All Brands ===");
        $brands = Brand::all();
        $this->table(['ID', 'Name', 'Country', 'Active'], $brands->map(fn($b) => [
            $b->id, $b->name, $b->country, $b->is_active ? 'Yes' : 'No'
        ]));

        // Test brandStatus scope
        $this->info("\n=== Active Brands ===");
        $activeBrands = Brand::brandStatus(true)->get();
        $this->line($activeBrands->pluck('name')->join(', '));

        // Test fromCountry scope
        $this->info("\n=== Brands from China ===");
        $usaBrands = Brand::fromCountry('China')->get();
        $this->line($usaBrands->pluck('name')->join(', '));

        // Test relation: flavours
        $this->info("\n=== Brands with Flavours ===");
        $withFlavours = Brand::with('flavours')->get();
        foreach ($withFlavours as $brand) {
            $this->line($brand->name . ' => ' . $brand->flavours->pluck('name')->join(', '));
        }

        // Get all brands that have a flavour containing "Mint"
        $this->info("\n=== Brands with Flavour Hulda Doyle ===");
        $brands = Brand::byFlavour('Hulda Doyle')->get();
        $this->line($brands->pluck('name')->join(', '));


    }
}
