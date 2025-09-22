<?php

namespace App\Console\Commands;

use App\Models\Vape\Liquid;
use Illuminate\Console\Command;

class testLiquid extends Command
{
     protected $signature = 'test:liquid 
                            {--flavour_id= : Filter by flavour id} 
                            {--nicotine_type= : Filter by nicotine type} 
                            {--vape_style= : Filter by vape style} 
                            {--search= : Search keyword} 
                            {--min_strength= : Minimum strength} 
                            {--max_strength= : Maximum strength}';

    protected $description = 'Test Liquid model scopes and attributes';

    public function handle()
    {
        $query = Liquid::with(['flavour','strengthNic']);

        if ($fid = $this->option('flavour_id')) {
            $query->byFlavour($fid);
        }
        if ($nt = $this->option('nicotine_type')) {
            $query->byNicotineType($nt);
        }
        if ($vs = $this->option('vape_style')) {
            $query->byVapeStyle($vs);
        }
        if ($search = $this->option('search')) {
            $query->search($search);
        }
        if ($this->option('min_strength') && $this->option('max_strength')) {
            $query->byStrengthBetween($this->option('min_strength'), $this->option('max_strength'));
        }

        $liquids = $query->get();

        if ($liquids->isEmpty()) {
            $this->warn("No liquids found.");
            return;
        }

        foreach ($liquids as $liquid) {
            $this->info("Liquid: {$liquid->name}");
            $this->line("  Details: " . json_encode($liquid->details));
            $this->line("  Label: " . $liquid->label);
            $this->line(str_repeat('-', 40));
        }
    }
}
