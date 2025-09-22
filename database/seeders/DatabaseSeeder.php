<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
   
    public function run(): void
    {
        
        $this->call([
            EJuiceCategorySeeder::class , 
            BrandSeeder::class , 
            HardwareDevicesSeeders::class , 
            DeviceCategoriesFeaturesSeeder::class ,
            TanksSeeders::class , 
            CoilsSeeders::class , 
            CartridgesSeeders::class , 
        ]
        );
    }
}
