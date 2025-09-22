<?php

namespace Database\Seeders;

use App\Models\Coils\Coils;
use App\Models\Coils\CoilSeries;
use App\Models\Hardware\DeviceBrands;
use App\Models\Hardware\DevicesCategories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CoilsSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
            'Innokin' => [
                'country' => 'China',
                'website' => 'https://www.innokin.com',
                'description' => 'Pioneers in MTL vaping and known for reliable, flavor-focused tanks.',
                'coil_series' => [
                    [
                        'series_name' => 'Z-Coils',
                        'series_description' => 'Popular coil series for MTL and RDL vaping',
                        'coils' => [
                            [
                                'name' => 'Z-Coil 0.3Ω',
                                'resistance' => 0.3,
                                'wattage_range' => '30-40W',
                                'vaping_style' => 'dl',
                                'description' => 'Mesh coil for direct lung vaping',
                                'price_range' => '80 - 100 EGP',
                                'pack_size' => 5
                            ],
                            [
                                'name' => 'Z-Coil 0.5Ω',
                                'resistance' => 0.5,
                                'wattage_range' => '14-19W',
                                'vaping_style' => 'mtl',
                                'description' => 'Regular coil for mouth-to-lung vaping',
                                'price_range' => '70 - 90 EGP',
                                'pack_size' => 5
                            ],
                            [
                                'name' => 'Z-Coil 0.8Ω',
                                'resistance' => 0.8,
                                'wattage_range' => '14-17W',
                                'vaping_style' => 'mtl',
                                'description' => 'Tight draw for traditional MTL experience',
                                'price_range' => '70 - 90 EGP',
                                'pack_size' => 5
                            ],
                            [
                                'name' => 'Z-Coil 1.0Ω',
                                'resistance' => 1.0,
                                'wattage_range' => '10-14W',
                                'vaping_style' => 'mtl',
                                'description' => 'High resistance for nicotine salts',
                                'price_range' => '70 - 90 EGP',
                                'pack_size' => 5
                            ]
                        ]
                    ]
                ]
            ],
            'VooPoo' => [
                'country' => 'China',
                'website' => 'https://www.voopoo.com',
                'description' => 'Famous for the GENE chip and popular pod systems and tanks.',
                'coil_series' => [
                    [
                        'series_name' => 'PnP Coils',
                        'series_description' => 'Versatile coil series for various vaping styles',
                        'coils' => [
                            [
                                'name' => 'PnP Coil 0.15Ω',
                                'resistance' => 0.15,
                                'wattage_range' => '60-80W',
                                'vaping_style' => 'dl',
                                'description' => 'Mesh coil for cloud chasing',
                                'price_range' => '90 - 110 EGP',
                                'pack_size' => 5
                            ],
                            [
                                'name' => 'PnP Coil 0.2Ω',
                                'resistance' => 0.2,
                                'wattage_range' => '50-60W',
                                'vaping_style' => 'dl',
                                'description' => 'Dual mesh for balanced flavor and vapor',
                                'price_range' => '90 - 110 EGP',
                                'pack_size' => 5
                            ],
                            [
                                'name' => 'PnP Coil 0.3Ω',
                                'resistance' => 0.3,
                                'wattage_range' => '35-45W',
                                'vaping_style' => 'rdl',
                                'description' => 'Restricted direct lung coil',
                                'price_range' => '80 - 100 EGP',
                                'pack_size' => 5
                            ],
                            [
                                'name' => 'PnP Coil 0.6Ω',
                                'resistance' => 0.6,
                                'wattage_range' => '20-25W',
                                'vaping_style' => 'mtl',
                                'description' => 'Loose MTL/RDL hybrid coil',
                                'price_range' => '70 - 90 EGP',
                                'pack_size' => 5
                            ],
                            [
                                'name' => 'PnP Coil 0.8Ω',
                                'resistance' => 0.8,
                                'wattage_range' => '15-18W',
                                'vaping_style' => 'mtl',
                                'description' => 'Standard MTL coil',
                                'price_range' => '70 - 90 EGP',
                                'pack_size' => 5
                            ],
                            [
                                'name' => 'PnP Coil 1.0Ω',
                                'resistance' => 1.0,
                                'wattage_range' => '12-15W',
                                'vaping_style' => 'mtl',
                                'description' => 'Tight MTL for higher nicotine',
                                'price_range' => '70 - 90 EGP',
                                'pack_size' => 5
                            ],
                            [
                                'name' => 'PnP Coil 1.2Ω',
                                'resistance' => 1.2,
                                'wattage_range' => '10-12W',
                                'vaping_style' => 'mtl',
                                'description' => 'Extra tight MTL for nicotine salts',
                                'price_range' => '70 - 90 EGP',
                                'pack_size' => 5
                            ]
                        ]
                    ]
                ]
            ],
            'Vaporesso' => [
                'country' => 'China',
                'website' => 'https://www.vaporesso.com',
                'description' => 'A leading innovator in vaping technology, known for high-quality devices and tanks.',
                'coil_series' => [
            [
                'series_name' => 'GTX Coils',
                'series_description' => 'Advanced mesh coils for excellent flavor production',
                'coils' => [
                    [
                        'name' => 'GTX Coil 0.15Ω',
                        'resistance' => 0.15,
                        'wattage_range' => '60-75W',
                        'vaping_style' => 'dl',
                        'description' => 'Mesh coil for massive vapor production',
                        'price_range' => '85 - 105 EGP',
                        'pack_size' => 3
                    ],
                    [
                        'name' => 'GTX Coil 0.2Ω',
                        'resistance' => 0.2,
                        'wattage_range' => '50-60W',
                        'vaping_style' => 'dl',
                        'description' => 'Balanced flavor and vapor production',
                        'price_range' => '85 - 105 EGP',
                        'pack_size' => 3
                    ],
                    [
                        'name' => 'GTX Coil 0.3Ω',
                        'resistance' => 0.3,
                        'wattage_range' => '32-40W',
                        'vaping_style' => 'rdl',
                        'description' => 'Restricted direct lung with excellent flavor',
                        'price_range' => '75 - 95 EGP',
                        'pack_size' => 3
                    ],
                    [
                        'name' => 'GTX Coil 0.4Ω',
                        'resistance' => 0.4,
                        'wattage_range' => '24-28W',
                        'vaping_style' => 'rdl',
                        'description' => 'Smooth restricted direct lung experience',
                        'price_range' => '75 - 95 EGP',
                        'pack_size' => 3
                    ],
                    [
                        'name' => 'GTX Coil 0.6Ω',
                        'resistance' => 0.6,
                        'wattage_range' => '20-24W',
                        'vaping_style' => 'mtl',
                        'description' => 'Loose MTL with good flavor',
                        'price_range' => '65 - 85 EGP',
                        'pack_size' => 3
                    ]
                ]
            ]
            ]
            ],
            'Freemax' => [
                'country' => 'China',
                'website' => 'https://www.freemaxvape.com',
                'description' => 'Renowned for exceptional flavor production and innovative mesh coil technology.',
                'coil_series' => [
                    [
                        'series_name' => 'Fireluke Mesh Coils',
                        'series_description' => 'Premium mesh coils for maximum flavor intensity',
                        'coils' => [
                            [
                                'name' => 'Fireluke Mesh 0.15Ω',
                                'resistance' => 0.15,
                                'wattage_range' => '60-90W',
                                'vaping_style' => 'dl',
                                'description' => 'Stainless steel mesh for intense flavor',
                                'price_range' => '95 - 115 EGP',
                                'pack_size' => 3
                            ],
                            [
                                'name' => 'Fireluke Mesh 0.2Ω',
                                'resistance' => 0.2,
                                'wattage_range' => '50-80W',
                                'vaping_style' => 'dl',
                                'description' => 'Dual mesh for rich vapor production',
                                'price_range' => '95 - 115 EGP',
                                'pack_size' => 3
                            ],
                            [
                                'name' => 'Fireluke Mesh 0.25Ω',
                                'resistance' => 0.25,
                                'wattage_range' => '40-60W',
                                'vaping_style' => 'rdl',
                                'description' => 'Triple mesh for exceptional flavor clarity',
                                'price_range' => '85 - 105 EGP',
                                'pack_size' => 3
                            ]
                        ]
                    ],
                    [
                        'series_name' => 'MaxPod Coils',
                        'series_description' => 'Compact coils for pod systems and MTL vaping',
                        'coils' => [
                            [
                                'name' => 'MaxPod Coil 0.5Ω',
                                'resistance' => 0.5,
                                'wattage_range' => '15-20W',
                                'vaping_style' => 'mtl',
                                'description' => 'Mesh coil for pod systems',
                                'price_range' => '60 - 80 EGP',
                                'pack_size' => 5
                            ],
                            [
                                'name' => 'MaxPod Coil 1.0Ω',
                                'resistance' => 1.0,
                                'wattage_range' => '10-12W',
                                'vaping_style' => 'mtl',
                                'description' => 'Standard resistance for nicotine salts',
                                'price_range' => '60 - 80 EGP',
                                'pack_size' => 5
                            ],
                            [
                                'name' => 'MaxPod Coil 1.5Ω',
                                'resistance' => 1.5,
                                'wattage_range' => '7-9W',
                                'vaping_style' => 'mtl',
                                'description' => 'High resistance for tight MTL draw',
                                'price_range' => '60 - 80 EGP',
                                'pack_size' => 5
                            ]
                        ]
                    ]
                ]
            ],
            'Uwell' => [
                'country' => 'China',
                'website' => 'https://www.uwell.com',
                'description' => 'Known for exceptional build quality and flavor-focused tanks.',
                'coil_series' => [
                    [
                        'series_name' => 'Crown V Coils',
                        'series_description' => 'Professional-grade coils for flavor enthusiasts',
                        'coils' => [
                            [
                                'name' => 'Crown V Coil 0.15Ω',
                                'resistance' => 0.15,
                                'wattage_range' => '70-90W',
                                'vaping_style' => 'dl',
                                'description' => 'Quad mesh for massive cloud production',
                                'price_range' => '100 - 120 EGP',
                                'pack_size' => 3
                            ],
                            [
                                'name' => 'Crown V Coil 0.23Ω',
                                'resistance' => 0.23,
                                'wattage_range' => '55-65W',
                                'vaping_style' => 'dl',
                                'description' => 'Triple mesh for balanced performance',
                                'price_range' => '100 - 120 EGP',
                                'pack_size' => 3
                            ],
                            [
                                'name' => 'Crown V Coil 0.3Ω',
                                'resistance' => 0.3,
                                'wattage_range' => '40-50W',
                                'vaping_style' => 'rdl',
                                'description' => 'Dual mesh for flavor-focused vaping',
                                'price_range' => '90 - 110 EGP',
                                'pack_size' => 3
                            ]
                        ]
                    ],
                    [
                        'series_name' => 'Valyrian Coils',
                        'series_description' => 'High-performance coils for advanced vapers',
                        'coils' => [
                            [
                                'name' => 'Valyrian Coil 0.16Ω',
                                'resistance' => 0.16,
                                'wattage_range' => '80-100W',
                                'vaping_style' => 'dl',
                                'description' => 'Quadruple mesh for extreme vapor',
                                'price_range' => '110 - 130 EGP',
                                'pack_size' => 2
                            ],
                            [
                                'name' => 'Valyrian Coil 0.14Ω',
                                'resistance' => 0.14,
                                'wattage_range' => '90-110W',
                                'vaping_style' => 'dl',
                                'description' => 'Quintuple mesh for ultimate performance',
                                'price_range' => '110 - 130 EGP',
                                'pack_size' => 2
                            ]
                        ]
                    ]
                ]
            ],
            'SMOK' => [
                'country' => 'China',
                'website' => 'https://www.smok.com',
                'description' => 'One of the most popular vape brands worldwide with extensive coil options.',
                'coil_series' => [
                    [
                        'series_name' => 'TFV Coils',
                        'series_description' => 'Legendary coils for cloud chasing and flavor',
                        'coils' => [
                            [
                                'name' => 'TFV18 Coil 0.15Ω',
                                'resistance' => 0.15,
                                'wattage_range' => '60-90W',
                                'vaping_style' => 'dl',
                                'description' => 'Single mesh for TFV18 tanks',
                                'price_range' => '80 - 100 EGP',
                                'pack_size' => 3
                            ],
                            [
                                'name' => 'TFV18 Coil 0.33Ω',
                                'resistance' => 0.33,
                                'wattage_range' => '60-75W',
                                'vaping_style' => 'dl',
                                'description' => 'Dual mesh for balanced performance',
                                'price_range' => '80 - 100 EGP',
                                'pack_size' => 3
                            ],
                            [
                                'name' => 'TFV18 Coil 0.15Ω Dual',
                                'resistance' => 0.15,
                                'wattage_range' => '80-140W',
                                'vaping_style' => 'dl',
                                'description' => 'Dual mesh for extreme cloud production',
                                'price_range' => '90 - 110 EGP',
                                'pack_size' => 3
                            ]
                        ]
                    ],
                    [
                        'series_name' => 'Nord Coils',
                        'series_description' => 'Compact coils for SMOK pod systems',
                        'coils' => [
                            [
                                'name' => 'Nord Coil 0.4Ω',
                                'resistance' => 0.4,
                                'wattage_range' => '25-30W',
                                'vaping_style' => 'rdl',
                                'description' => 'Mesh coil for Nord devices',
                                'price_range' => '50 - 70 EGP',
                                'pack_size' => 5
                            ],
                            [
                                'name' => 'Nord Coil 0.6Ω',
                                'resistance' => 0.6,
                                'wattage_range' => '15-20W',
                                'vaping_style' => 'mtl',
                                'description' => 'Standard MTL coil',
                                'price_range' => '50 - 70 EGP',
                                'pack_size' => 5
                            ],
                            [
                                'name' => 'Nord Coil 0.8Ω',
                                'resistance' => 0.8,
                                'wattage_range' => '12-16W',
                                'vaping_style' => 'mtl',
                                'description' => 'Tight MTL draw',
                                'price_range' => '50 - 70 EGP',
                                'pack_size' => 5
                            ],
                            [
                                'name' => 'Nord Coil 1.0Ω',
                                'resistance' => 1.0,
                                'wattage_range' => '10-12W',
                                'vaping_style' => 'mtl',
                                'description' => 'High resistance for salts',
                                'price_range' => '50 - 70 EGP',
                                'pack_size' => 5
                            ]
                        ]
                    ]
                ]
            ],
            'Hellvape' => [
                'country' => 'China',
                'website' => 'https://www.hellvape.com',
                'description' => 'Specializes in rebuildable atomizers and sub-ohm tanks for advanced vapers.',
                'coil_series' => [
                    [
                        'series_name' => 'Hell Coils',
                        'series_description' => 'High-performance coils for Hellvape tanks',
                        'coils' => [
                            [
                                'name' => 'Hell Coil 0.2Ω',
                                'resistance' => 0.2,
                                'wattage_range' => '60-80W',
                                'vaping_style' => 'dl',
                                'description' => 'Mesh coil for Fat Rabbit tanks',
                                'price_range' => '85 - 105 EGP',
                                'pack_size' => 3
                            ],
                            [
                                'name' => 'Hell Coil 0.4Ω',
                                'resistance' => 0.4,
                                'wattage_range' => '50-60W',
                                'vaping_style' => 'dl',
                                'description' => 'Dual mesh for balanced vaping',
                                'price_range' => '85 - 105 EGP',
                                'pack_size' => 3
                            ],
                            [
                                'name' => 'Hell Coil 0.6Ω',
                                'resistance' => 0.6,
                                'wattage_range' => '30-40W',
                                'vaping_style' => 'rdl',
                                'description' => 'Single mesh for restricted lung',
                                'price_range' => '75 - 95 EGP',
                                'pack_size' => 3
                            ]
                        ]
                    ]
                ]
            ]
        ];

        foreach($brands as $brand=>$brandDetails){
            $coil_brand = DeviceBrands::firstOrCreate([
                'name' => $brand,
                'country' => $brandDetails['country'],
                'website'=> $brandDetails['website'],
                'description'=>$brandDetails['description']
            ]);
            $category_id = DevicesCategories::where('name','Coils & Pods')->value('id');
            $coilSeries = $brandDetails['coil_series'];
            foreach($coilSeries as $coilSer){
                $coilSeriesModel = CoilSeries::create(['name'=>$coilSer['series_name'] , 
                'description'=>$coilSer['series_description'],
                'brand_id'=>$coil_brand->id , 'category_id'=>$category_id]);
                $coils = $coilSer['coils'];
                foreach($coils as $coil){
                    Coils::create(['coil_series_id'=>$coilSeriesModel->id , 'name'=>$coil['name'] , 
                    'resistance'=>$coil['resistance'] , 'wattage_range'=>$coil['wattage_range'] ,'vaping_style'=>$coil['vaping_style'] 
                    ,'description'=>$coil['description'] ]);
                }
            }
        }
    }
}
