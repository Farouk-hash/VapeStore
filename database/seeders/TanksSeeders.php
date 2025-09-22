<?php

namespace Database\Seeders;

use App\Models\Hardware\DeviceBrands;
use App\Models\Hardware\DevicesCategories;
use App\Models\Tanks\Tanks;
use App\Models\Tanks\TanksColors;
use App\Models\Tanks\TanksSpecs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TanksSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [
             'Lost Vape' => [
                'country' => 'China',
                'website' => 'https://www.lostvape.com',
                'description' => 'Premium brand known for high-end DNA chip devices and luxury vaping products.',
                'tanks' => [
                    [
                        'name' => 'Lost Vape Ursa Baby Pod Tank',
                        'type' => 'podtank',
                        'vaping_style' => 'mtl',
                        'release_year' => '2023',
                        'price_range' => '280 - 340 EGP',
                        'available_colors' => ['Black', 'Silver', 'Blue', 'Green', 'Red'],
                        'main_specs' => [
                            'capacity' => '3ml',
                            'coil_series' => 'UB Pro Coils',
                            'compatibility' => 'Lost Vape Ursa Baby'
                        ],
                        'compatible_coils' => ['0.6Ω (20W)', '0.8Ω (16W)', '1.0Ω (12W)', '1.2Ω (10W)'],
                    ],
                    [
                        'name' => 'Lost Vape Centaurus Q200 Tank',
                        'type' => 'subohm',
                        'vaping_style' => 'dl',
                        'release_year' => '2022',
                        'price_range' => '520 - 600 EGP',
                        'available_colors' => ['Black', 'Stainless Steel', 'Gold', 'Rainbow'],
                        'main_specs' => [
                            'capacity' => '6.5ml',
                            'coil_series' => 'Quest Coils',
                            'thread_type' => '510'
                        ],
                        'compatible_coils' => ['0.15Ω (70-85W)', '0.2Ω (60-75W)', '0.4Ω (50-60W)'],
                    ]
                ]
            ],
            'Vandy Vape' => [
                'country' => 'China',
                'website' => 'https://www.vandyvape.com',
                'description' => 'Innovative brand specializing in rebuildable atomizers and advanced vaping gear.',
                'tanks' => [
                    [
                        'name' => 'Vandy Vape Pulse V3 RBA',
                        'type' => 'rba',
                        'vaping_style' => 'dl',
                        'release_year' => '2023',
                        'price_range' => '450 - 520 EGP',
                        'available_colors' => ['Black', 'Stainless Steel', 'Gunmetal', 'Blue'],
                        'main_specs' => [
                            'capacity' => '8ml',
                            'coil_series' => 'Rebuildable',
                            'compatibility' => 'Boro-style devices'
                        ],
                        'compatible_coils' => ['Build Your Own (Single Coil)'],
                    ],
                    [
                        'name' => 'Vandy Vape Kylin M Pro Tank',
                        'type' => 'subohm',
                        'vaping_style' => 'dl',
                        'release_year' => '2022',
                        'price_range' => '380 - 450 EGP',
                        'available_colors' => ['Black', 'Stainless Steel', 'Gold', 'Rainbow'],
                        'main_specs' => [
                            'capacity' => '6ml',
                            'coil_series' => 'Kylin M Coils',
                            'thread_type' => '510'
                        ],
                        'compatible_coils' => ['0.15Ω (65-75W)', '0.2Ω (55-65W)', '0.3Ω (45-55W)'],
                    ]
                ]
            ],
            'OXVA' => [
                'country' => 'China',
                'website' => 'https://www.oxva.com',
                'description' => 'Rising brand known for innovative pod systems and reliable performance.',
                'tanks' => [
                    [
                        'name' => 'OXVA XLIM Pro Pod Tank',
                        'type' => 'podtank',
                        'vaping_style' => 'mtl',
                        'release_year' => '2023',
                        'price_range' => '220 - 280 EGP',
                        'available_colors' => ['Black', 'Silver', 'Blue', 'Pink', 'Green'],
                        'main_specs' => [
                            'capacity' => '3ml',
                            'coil_series' => 'XLIM Coils',
                            'compatibility' => 'OXVA XLIM Series'
                        ],
                        'compatible_coils' => ['0.6Ω (20W)', '0.8Ω (16W)', '1.2Ω (12W)'],
                    ],
                    [
                        'name' => 'OXVA Arbiter 2 RTA',
                        'type' => 'rta',
                        'vaping_style' => 'dl',
                        'release_year' => '2022',
                        'price_range' => '500 - 580 EGP',
                        'available_colors' => ['Black', 'Stainless Steel', 'Gunmetal', 'Gold'],
                        'main_specs' => [
                            'capacity' => '5ml',
                            'coil_series' => 'Rebuildable',
                            'thread_type' => '510'
                        ],
                        'compatible_coils' => ['Build Your Own (Dual Coil)'],
                    ]
                ]
            ],
            'Dovpo' => [
                'country' => 'China',
                'website' => 'https://www.dovpo.com',
                'description' => 'Quality manufacturer known for durable devices and collaborations with vaping influencers.',
                'tanks' => [
                    [
                        'name' => 'Dovpo Blotto Max RTA',
                        'type' => 'rta',
                        'vaping_style' => 'dl',
                        'release_year' => '2022',
                        'price_range' => '550 - 630 EGP',
                        'available_colors' => ['Black', 'Stainless Steel', 'Gunmetal', 'Rainbow'],
                        'main_specs' => [
                            'capacity' => '6ml',
                            'coil_series' => 'Rebuildable',
                            'thread_type' => '510'
                        ],
                        'compatible_coils' => ['Build Your Own (Dual Coil)'],
                    ],
                    [
                        'name' => 'Dovpo Topside Squonk Tank',
                        'type' => 'squonk',
                        'vaping_style' => 'dl',
                        'release_year' => '2021',
                        'price_range' => '320 - 380 EGP',
                        'available_colors' => ['Black', 'Silver', 'Blue', 'Red'],
                        'main_specs' => [
                            'capacity' => '10ml',
                            'coil_series' => 'Squonk Bottle',
                            'compatibility' => 'Squonk mods'
                        ],
                        'compatible_coils' => ['N/A (Squonk Bottle)'],
                    ]
                ]
            ],
            'Wotofo' => [
                'country' => 'China',
                'website' => 'https://www.wotofo.com',
                'description' => 'Innovative brand famous for rebuildable atomizers and beginner-friendly products.',
                'tanks' => [
                    [
                        'name' => 'Wotofo Profile X RTA',
                        'type' => 'rta',
                        'vaping_style' => 'dl',
                        'release_year' => '2023',
                        'price_range' => '480 - 550 EGP',
                        'available_colors' => ['Black', 'Stainless Steel', 'Gunmetal', 'Rainbow'],
                        'main_specs' => [
                            'capacity' => '5.5ml',
                            'coil_series' => 'Mesh Rebuildable',
                            'thread_type' => '510'
                        ],
                        'compatible_coils' => ['Mesh Strips (50-70W)'],
                    ],
                    [
                        'name' => 'Wotofo NexMesh Pro Tank',
                        'type' => 'subohm',
                        'vaping_style' => 'dl',
                        'release_year' => '2022',
                        'price_range' => '350 - 420 EGP',
                        'available_colors' => ['Black', 'Stainless Steel', 'Blue', 'Gold'],
                        'main_specs' => [
                            'capacity' => '5ml',
                            'coil_series' => 'NexMesh Coils',
                            'thread_type' => '510'
                        ],
                        'compatible_coils' => ['0.15Ω (60-80W)', '0.2Ω (50-70W)', '0.3Ω (40-55W)'],
                    ]
                ]
            ],
            'Augvape' => [
                'country' => 'China',
                'website' => 'https://www.augvape.com',
                'description' => 'Known for innovative atomizer designs and quality manufacturing.',
                'tanks' => [
                    [
                        'name' => 'Augvape Intake MTL RTA',
                        'type' => 'rta',
                        'vaping_style' => 'mtl',
                        'release_year' => '2021',
                        'price_range' => '400 - 470 EGP',
                        'available_colors' => ['Black', 'Stainless Steel', 'Gunmetal'],
                        'main_specs' => [
                            'capacity' => '3.5ml',
                            'coil_series' => 'Rebuildable',
                            'thread_type' => '510'
                        ],
                        'compatible_coils' => ['Build Your Own (Single Coil)'],
                    ],
                    [
                        'name' => 'Augvape Druga Foxy Tank',
                        'type' => 'subohm',
                        'vaping_style' => 'dl',
                        'release_year' => '2022',
                        'price_range' => '320 - 380 EGP',
                        'available_colors' => ['Black', 'Stainless Steel', 'Blue', 'Rainbow'],
                        'main_specs' => [
                            'capacity' => '5ml',
                            'coil_series' => 'Druga Coils',
                            'thread_type' => '510'
                        ],
                        'compatible_coils' => ['0.2Ω (55-65W)', '0.3Ω (45-55W)', '0.4Ω (35-45W)'],
                    ]
                ]
            ],
            'Vessel' => [
                'country' => 'USA',
                'website' => 'https://vesselbrand.com',
                'description' => 'Premium American brand focusing on luxury design and high-quality materials.',
                'tanks' => [
                    [
                        'name' => 'Vessel Core Pod Tank',
                        'type' => 'podtank',
                        'vaping_style' => 'mtl',
                        'release_year' => '2023',
                        'price_range' => '300 - 360 EGP',
                        'available_colors' => ['Black', 'Silver', 'Gold', 'Rose Gold'],
                        'main_specs' => [
                            'capacity' => '2.5ml',
                            'coil_series' => 'Vessel Core Coils',
                            'compatibility' => 'Vessel Core Series'
                        ],
                        'compatible_coils' => ['1.0Ω (12W)', '1.2Ω (10W)'],
                    ]
                ]
            ],
            'ThunderHead' => [
                'country' => 'China',
                'website' => 'https://www.thunderheadcreations.com',
                'description' => 'Specializes in innovative rebuildable atomizers and advanced vaping technology.',
                'tanks' => [
                    [
                        'name' => 'ThunderHead Tauren Elite RTA',
                        'type' => 'rta',
                        'vaping_style' => 'dl',
                        'release_year' => '2022',
                        'price_range' => '520 - 590 EGP',
                        'available_colors' => ['Black', 'Stainless Steel', 'Brass', 'Copper'],
                        'main_specs' => [
                            'capacity' => '6ml',
                            'coil_series' => 'Rebuildable',
                            'thread_type' => '510'
                        ],
                        'compatible_coils' => ['Build Your Own (Dual Coil)'],
                    ]
                ]
            ],
            'SMOK' => [
                'country' => 'China',
                'website' => 'https://www.smok.com',
                'description' => 'One of the most popular vape brands worldwide, known for innovative designs and wide product range.',
                'tanks' => [
                    [
                        'name' => 'SMOK TFV18 Tank',
                        'type' => 'subohm',
                        'vaping_style' => 'dl',
                        'release_year' => '2021',
                        'price_range' => '450 - 550 EGP',
                        'available_colors' => ['Black', 'Stainless Steel', 'Blue', 'Red', 'Rainbow'],
                        'main_specs' => [
                            'capacity' => '7.5ml',
                            'coil_series' => 'TFV18 Coils',
                            'thread_type' => '510'
                        ],
                        'compatible_coils' => ['0.15Ω (60-90W)', '0.33Ω (60-75W)', '0.15Ω Dual (80-140W)'],
                    ],
                    [
                        'name' => 'SMOK Nord Pod Tank',
                        'type' => 'podtank',
                        'vaping_style' => 'mtl',
                        'release_year' => '2023',
                        'price_range' => '200 - 250 EGP',
                        'available_colors' => ['Black', 'Grey', 'Blue', 'Green', 'Purple'],
                        'main_specs' => [
                            'capacity' => '4ml',
                            'coil_series' => 'Nord Coils',
                            'compatibility' => 'SMOK Nord Series'
                        ],
                        'compatible_coils' => ['0.4Ω (25W)', '0.6Ω (15W)', '0.8Ω (12W)', '1.0Ω (10W)'],
                    ]
                ]
            ],
            'Freemax' => [
                'country' => 'China',
                'website' => 'https://www.freemaxvape.com',
                'description' => 'Renowned for exceptional flavor production and innovative mesh coil technology.',
                'tanks' => [
                    [
                        'name' => 'Freemax Fireluke 4 Tank',
                        'type' => 'subohm',
                        'vaping_style' => 'dl',
                        'release_year' => '2022',
                        'price_range' => '420 - 480 EGP',
                        'available_colors' => ['Black', 'Stainless Steel', 'Blue', 'Gunmetal', 'Rainbow'],
                        'main_specs' => [
                            'capacity' => '5ml',
                            'coil_series' => 'FX Mesh Coils',
                            'thread_type' => '510'
                        ],
                        'compatible_coils' => ['0.15Ω (60-90W)', '0.2Ω (50-80W)', '0.25Ω (40-60W)'],
                    ],
                    [
                        'name' => 'Freemax MaxPod Pod Tank',
                        'type' => 'podtank',
                        'vaping_style' => 'mtl',
                        'release_year' => '2023',
                        'price_range' => '180 - 220 EGP',
                        'available_colors' => ['Black', 'Silver', 'Blue', 'Red'],
                        'main_specs' => [
                            'capacity' => '3ml',
                            'coil_series' => 'MaxPod Coils',
                            'compatibility' => 'Freemax MaxPod'
                        ],
                        'compatible_coils' => ['0.5Ω (15W)', '1.0Ω (10W)', '1.5Ω (7W)'],
                    ]
                ]
            ],
            'Uwell' => [
                'country' => 'China',
                'website' => 'https://www.uwell.com',
                'description' => 'Known for exceptional build quality and flavor-focused tanks, particularly the Crown series.',
                'tanks' => [
                    [
                        'name' => 'Uwell Crown V Tank',
                        'type' => 'subohm',
                        'vaping_style' => 'dl',
                        'release_year' => '2023',
                        'price_range' => '480 - 550 EGP',
                        'available_colors' => ['Black', 'Stainless Steel', 'Gold', 'Blue', 'Purple'],
                        'main_specs' => [
                            'capacity' => '6ml',
                            'coil_series' => 'Crown V Coils',
                            'thread_type' => '510'
                        ],
                        'compatible_coils' => ['0.15Ω (70-90W)', '0.23Ω (55-65W)', '0.3Ω (40-50W)'],
                    ],
                    [
                        'name' => 'Uwell Valyrian Pod Tank',
                        'type' => 'podtank',
                        'vaping_style' => 'rdl',
                        'release_year' => '2022',
                        'price_range' => '220 - 280 EGP',
                        'available_colors' => ['Black', 'Grey', 'Red', 'Green'],
                        'main_specs' => [
                            'capacity' => '4.5ml',
                            'coil_series' => 'Valyrian Coils',
                            'compatibility' => 'Uwell Valyrian Pod'
                        ],
                        'compatible_coils' => ['0.3Ω (32W)', '0.6Ω (22W)', '0.8Ω (18W)'],
                    ]
                ]
            ],
            'Aspire' => [
                'country' => 'China',
                'website' => 'https://www.aspirecig.com',
                'description' => 'A pioneer in the vaping industry with a focus on quality and innovation since 2013.',
                'tanks' => [
                    [
                        'name' => 'Aspire Nautilus 3 Tank',
                        'type' => 'mtl',
                        'vaping_style' => 'mtl',
                        'release_year' => '2021',
                        'price_range' => '300 - 350 EGP',
                        'available_colors' => ['Stainless Steel', 'Black', 'Blue', 'Gold'],
                        'main_specs' => [
                            'capacity' => '4ml',
                            'coil_series' => 'Nautilus Coils',
                            'thread_type' => '510'
                        ],
                        'compatible_coils' => ['0.7Ω (18-23W)', '1.0Ω (13-15W)', '1.8Ω (10-14W)'],
                    ],
                    [
                        'name' => 'Aspire Flexus Q Pod Tank',
                        'type' => 'podtank',
                        'vaping_style' => 'rdl',
                        'release_year' => '2023',
                        'price_range' => '170 - 210 EGP',
                        'available_colors' => ['Black', 'Silver', 'Blue', 'Green'],
                        'main_specs' => [
                            'capacity' => '3ml',
                            'coil_series' => 'Flexus Coils',
                            'compatibility' => 'Aspire Flexus Q'
                        ],
                        'compatible_coils' => ['0.6Ω (20W)', '1.0Ω (12W)', '1.2Ω (10W)'],
                    ]
                ]
            ],
            'Hellvape' => [
                'country' => 'China',
                'website' => 'https://www.hellvape.com',
                'description' => 'Specializes in rebuildable atomizers and sub-ohm tanks for advanced vapers.',
                'tanks' => [
                    [
                        'name' => 'Hellvape Dead Rabbit V3 RTA',
                        'type' => 'rta',
                        'vaping_style' => 'dl',
                        'release_year' => '2023',
                        'price_range' => '550 - 650 EGP',
                        'available_colors' => ['Black', 'Stainless Steel', 'Gunmetal', 'Rainbow'],
                        'main_specs' => [
                            'capacity' => '6ml',
                            'coil_series' => 'Rebuildable',
                            'thread_type' => '510'
                        ],
                        'compatible_coils' => ['Build Your Own (Dual Coil)'],
                    ],
                    [
                        'name' => 'Hellvape Fat Rabbit Subohm Tank',
                        'type' => 'subohm',
                        'vaping_style' => 'dl',
                        'release_year' => '2022',
                        'price_range' => '400 - 470 EGP',
                        'available_colors' => ['Black', 'Stainless Steel', 'Blue', 'Red'],
                        'main_specs' => [
                            'capacity' => '5ml',
                            'coil_series' => 'Hell Coils',
                            'thread_type' => '510'
                        ],
                        'compatible_coils' => ['0.2Ω (60-80W)', '0.4Ω (50-60W)', '0.6Ω (30-40W)'],
                    ]
                ]
            ],
            'VapeEgypt' => [
                'country' => 'Egypt',
                'website' => 'https://vapeegypt.net',
                'description' => 'An Egyptian brand focusing on both beginner-friendly devices and advanced mod kits.',
                'tanks' => [
                    [
                        'name' => 'VapeEgypt Nile MTL Tank',
                        'type' => 'mtl',
                        'vaping_style' => 'mtl',
                        'release_year' => '2024',
                        'price_range' => '250 - 300 EGP',
                        'available_colors' => ['Matte Black', 'Gunmetal', 'Silver', 'Blue'],
                        'main_specs' => [
                            'capacity' => '3.0ml',
                            'coil_series' => 'Nile BVC Coils',
                            'thread_type' => '510'
                        ],
                        'compatible_coils' => ['1.0Ω (12-16W)', '0.8Ω (16-20W)', '1.2Ω (10-12W)'],
                    ],
                    [
                        'name' => 'VapeEgypt Pharaoh Sub-Ohm Tank',
                        'type' => 'subohm',
                        'vaping_style' => 'dl',
                        'release_year' => '2023',
                        'price_range' => '300 - 350 EGP',
                        'available_colors' => ['Stainless Steel', 'Black', 'Gold', 'Rainbow'],
                        'main_specs' => [
                            'capacity' => '5.0ml',
                            'coil_series' => 'Pharaoh Coils',
                            'thread_type' => '510'
                        ],
                        'compatible_coils' => ['0.2Ω (60-75W)', '0.4Ω (40-55W)', '0.8Ω (20-25W)'],
                    ],
                    [
                        'name' => 'VapeEgypt Horizon Pod Tank',
                        'type' => 'podtank',
                        'vaping_style' => 'rdl',
                        'release_year' => '2024',
                        'price_range' => '180 - 220 EGP',
                        'available_colors' => ['Black', 'Grey', 'Red', 'Green'],
                        'main_specs' => [
                            'capacity' => '4.5ml',
                            'coil_series' => 'Horizon Pods',
                            'compatibility' => 'Delta & Alpha Pod Mods'
                        ],
                        'compatible_coils' => ['0.6Ω (20-25W)', '1.0Ω (12-15W)'],
                    ]
                ]
            ],
            'Vaporesso' => [
                'country' => 'China',
                'website' => 'https://www.vaporesso.com',
                'description' => 'A leading innovator in vaping technology, known for high-quality devices and tanks.',
                'tanks' => [
                    [
                        'name' => 'Vaporesso iTank 2',
                        'type' => 'subohm',
                        'vaping_style' => 'dl',
                        'release_year' => '2023',
                        'price_range' => '400 - 500 EGP',
                        'available_colors' => ['Stainless Steel', 'Black', 'Blue', 'Gunmetal'],
                        'main_specs' => [
                            'capacity' => '8ml',
                            'coil_series' => 'GTX Coils',
                            'thread_type' => '510'
                        ],
                        'compatible_coils' => ['0.15Ω (60-75W)', '0.2Ω (50-60W)', '0.4Ω (50-60W)'],
                    ],
                    [
                        'name' => 'Vaporesso Luxe X Pro Pod Tank',
                        'type' => 'podtank',
                        'vaping_style' => 'rdl',
                        'release_year' => '2023',
                        'price_range' => '350 - 420 EGP',
                        'available_colors' => ['Black', 'Silver', 'Blue', 'Green'],
                        'main_specs' => [
                            'capacity' => '5ml',
                            'coil_series' => 'Vaporesso GTX Coils',
                            'compatibility' => 'Luxe X Pro'
                        ],
                        'compatible_coils' => ['0.3Ω (32-40W)', '0.4Ω (24-28W)', '0.6Ω (20-24W)'],
                    ]
                ]
            ],
            'GeekVape' => [
                'country' => 'China',
                'website' => 'https://www.geekvape.com',
                'description' => 'Renowned for durable, leak-proof designs and popular sub-ohm tanks.',
                'tanks' => [
                    [
                        'name' => 'GeekVape Z Subohm Tank',
                        'type' => 'subohm',
                        'vaping_style' => 'dl',
                        'release_year' => '2022',
                        'price_range' => '380 - 450 EGP',
                        'available_colors' => ['Stainless Steel', 'Black', 'Rainbow', 'Gunmetal'],
                        'main_specs' => [
                            'capacity' => '5.5ml',
                            'coil_series' => 'Z Series Coils',
                            'thread_type' => '510'
                        ],
                        'compatible_coils' => ['0.15Ω (70-85W)', '0.2Ω (70-80W)', '0.25Ω (45-57W)'],
                    ],
                    [
                        'name' => 'GeekVape Boost Pro Pod Tank',
                        'type' => 'podtank',
                        'vaping_style' => 'rdl',
                        'release_year' => '2021',
                        'price_range' => '300 - 370 EGP',
                        'available_colors' => ['Black', 'Blue', 'Red', 'Grey'],
                        'main_specs' => [
                            'capacity' => '5ml',
                            'coil_series' => 'P Series Coils',
                            'compatibility' => 'Boost Pro/Boro'
                        ],
                        'compatible_coils' => ['0.2Ω (60-70W)', '0.4Ω (50-60W)', '0.6Ω (20-28W)'],
                    ]
                ]
            ],
            'Innokin' => [
                'country' => 'China',
                'website' => 'https://www.innokin.com',
                'description' => 'Pioneers in MTL vaping and known for reliable, flavor-focused tanks.',
                'tanks' => [
                    [
                        'name' => 'Innokin Zenith II Tank',
                        'type' => 'mtl',
                        'vaping_style' => 'mtl',
                        'release_year' => '2021',
                        'price_range' => '320 - 380 EGP',
                        'available_colors' => ['Stainless Steel', 'Black', 'Gunmetal', 'Blue'],
                        'main_specs' => [
                            'capacity' => '5ml',
                            'coil_series' => 'Z-Coils',
                            'thread_type' => '510'
                        ],
                        'compatible_coils' => ['0.3Ω (30-40W)', '0.5Ω (14-19W)', '0.8Ω (14-17W)', '1.0Ω (10-14W)'],
                    ],
                    [
                        'name' => 'Innokin GoMax Disposable Tank',
                        'type' => 'disposable_tank',
                        'vaping_style' => 'mtl',
                        'release_year' => '2023',
                        'price_range' => '100 - 150 EGP',
                        'available_colors' => ['Pre-filled (Various)'],
                        'main_specs' => [
                            'capacity' => '4.2ml (Pre-filled)',
                            'coil_series' => 'Integrated',
                            'thread_type' => '510'
                        ],
                        'compatible_coils' => ['N/A (Disposable)'],
                    ]
                ]
            ],
            'VooPoo' => [
                'country' => 'China',
                'website' => 'https://www.voopoo.com',
                'description' => 'Famous for the GENE chip and popular pod systems and tanks.',
                'tanks' => [
                    [
                        'name' => 'VooPoo Uforce-L Tank',
                        'type' => 'subohm',
                        'vaping_style' => 'dl',
                        'release_year' => '2023',
                        'price_range' => '350 - 420 EGP',
                        'available_colors' => ['Black', 'Stainless Steel', 'Rainbow', 'Gold'],
                        'main_specs' => [
                            'capacity' => '6ml',
                            'coil_series' => 'PnP Coils',
                            'thread_type' => '510'
                        ],
                        'compatible_coils' => ['0.15Ω (60-80W)', '0.2Ω (50-60W)', '0.3Ω (35-45W)'],
                    ],
                    [
                        'name' => 'VooPoo PnP Pod Tank',
                        'type' => 'podtank',
                        'vaping_style' => 'mtl',
                        'release_year' => '2022',
                        'price_range' => '150 - 200 EGP',
                        'available_colors' => ['Black', 'Grey', 'Red', 'Blue'],
                        'main_specs' => [
                            'capacity' => '4.5ml',
                            'coil_series' => 'PnP Coils',
                            'compatibility' => 'Most VooPoo Pod Mods'
                        ],
                        'compatible_coils' => ['0.6Ω (20-25W)', '0.8Ω (15-18W)', '1.0Ω (12-15W)', '1.2Ω (10-12W)'],
                    ]
                ]
            ]
        ];
        
        foreach($brands as $brand => $brandDetails){
            $tank_brand = DeviceBrands::firstOrCreate([
                'name' => $brand,
                'country' => $brandDetails['country'],
                'website'=> $brandDetails['website'],
                'description'=>$brandDetails['description']
            ]);
            
            // tanks itself ; 
            $tanks = $brandDetails['tanks'];
            $categoryId = DevicesCategories::where('name','Tanks & Atomizers')->value('id');
            
            foreach($tanks as $tank){
                $tankModel=Tanks::create(['category_id'=>$categoryId , 'brand_id'=>$tank_brand->id , 'name'=>$tank['name'],
                'type'=>$tank['type'],'vaping_style'=>$tank['vaping_style'],'release_year'=>$tank['release_year']]);
                $tankColors = $tank['available_colors'];
                foreach($tankColors as $tankColor){
                    TanksColors::create(['tank_id'=>$tankModel->id , 'value'=>$tankColor]);
                }
                $tankSpecs = $tank['main_specs'];
                foreach($tankSpecs as $specKey =>$specValue){
                    TanksSpecs::create(['tank_id'=>$tankModel->id , 'spec_key'=> $specKey, 'spec_value'=>$specValue]);
                }
            }
            
        }
    }
}
