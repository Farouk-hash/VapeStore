<?php

namespace App\Console\Commands;

use App\Models\Vape\Flavour;
use Illuminate\Console\Command;

class testFlavours extends Command
{
   /**
     * The name and signature of the console command.
     *
     * Run it as: php artisan flavour:test
     */
    protected $signature = 'test:flavour
                            {--brand_id= : Filter by brand id} 
                            {--status= : Filter by active status (1/0)} 
                            {--search= : Keyword search}';

    /**
     * The console command description.
     */
    protected $description = 'Test Flavour model scopes and attributes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $query = Flavour::query();

        // Apply brand filter if passed
        if ($brandId = $this->option('brand_id')) {
            $query->byBrand($brandId);
        }

        // Apply status filter if passed
        if (!is_null($this->option('status'))) {
            $query->flavourStatus($this->option('status'));
        }

        // Apply search keyword if passed
        if ($keyword = $this->option('search')) {
            $query->search($keyword);
        }

        $flavours = $query->with(['brand','components'])->get();

        if ($flavours->isEmpty()) {
            $this->warn("No flavours found.");
            return;
        }

        foreach ($flavours as $flavour) {
            $this->info("Flavour: {$flavour->name}");

            $this->line("  Brand: " . json_encode($flavour->brand_name));
            $this->line("  Components: " . json_encode($flavour->flavours_list));
            $this->line("  Status: " . ($flavour->is_active ? 'Active' : 'Inactive'));
            $this->line(str_repeat('-', 40));
        }
    }
}
