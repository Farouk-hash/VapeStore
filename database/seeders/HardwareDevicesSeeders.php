<?php

namespace Database\Seeders;

use App\Models\CommonModels\Component;
use App\Models\Hardware\DeviceBrands;
use App\Models\Hardware\DeviceColors;
use App\Models\Hardware\DeviceFeatures;
use App\Models\Hardware\DeviceFlavors;
use App\Models\Hardware\DevicePuffs;
use App\Models\Hardware\Devices;
use App\Models\Hardware\DevicesCategories;
use App\Models\Hardware\DevicesSpecs;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HardwareDevicesSeeders extends Seeder
{
    
    public function run(): void
    {
       $brands = [
        // Egyptian Brands
        'SmokeX' => [
            'country' => 'Egypt',
            'website' => 'https://smoke-x-egypt.com',
            'description' => 'A leading Egyptian vape brand known for offering affordable and reliable pod systems and disposables tailored to the local market.',
            'categories' => [
                [
                    'name' => 'Pod System',
                    'devices' => [
                        [
                            'name' => 'SmokeX Mini Pro',
                            'release_year' => 2023,
                            'price_range' => '280 - 350 EGP',
                            'available_colors' => ['Onyx Black', 'Midnight Blue', 'Ruby Red', 'Graphite Grey'],
                            'available_flavors' => [],
                            'specs' => [
                                'battery_capacity' => '800mAh',
                                'charging_port' => 'USB-C',
                                'charging_time' => '45 minutes',
                                'coil_type' => 'Replaceable Pre-installed 0.8Ω Mesh Coil',
                                'pod_capacity' => '2ml (Refillable)',
                                'power_output' => 'Fixed 15W Output',
                                'activation' => 'Auto-Draw & Button Fire',
                                'display' => '3-Stage LED Battery Indicator',
                                'features' => ['Leak-Resistant Design', '2A Fast Charging', 'Overcharge Protection'],
                                'weight' => '38g',
                                'in_the_box' => '1x Device, 1x Pod, 1x USB-C Cable, User Manual'
                            ]
                        ],
                        [
                            'name' => 'SmokeX Nano Plus',
                            'release_year' => 2024,
                            'price_range' => '420 - 500 EGP',
                            'available_colors' => ['Stainless Steel', 'Iridescent Pearl', 'Forest Green', 'Matte Black'],
                            'available_flavors' => [],
                            'specs' => [
                                'battery_capacity' => '1000mAh',
                                'charging_port' => 'USB-C',
                                'charging_time' => '60 minutes',
                                'coil_type' => 'Replaceable Pods (0.6Ω Mesh for RDL, 1.0Ω Mesh for MTL)',
                                'pod_capacity' => '3ml (Refillable)',
                                'power_range' => '15W (1.0Ω) / 25W (0.6Ω) - Auto-Adjusting',
                                'activation' => 'Auto-Draw & Button Fire',
                                'display' => '0.42" OLED Screen (Shows Battery & Puff Count)',
                                'features' => ['Adjustable Airflow Slider', 'Short-Circuit Protection', 'Type-C Fast Charging'],
                                'weight' => '52g',
                                'in_the_box' => '1x Device, 1x 0.6Ω Pod, 1x 1.0Ω Pod, 1x USB-C Cable, User Manual'
                            ]
                        ],
                        [
                            'name' => 'SmokeX Ultra Pod',
                            'release_year' => 2023,
                            'price_range' => '380 - 450 EGP',
                            'available_colors' => ['Ocean Blue', 'Crimson Red', 'Emerald Green', 'Carbon Fiber'],
                            'available_flavors' => [],
                            'specs' => [
                                'battery_capacity' => '1200mAh',
                                'charging_port' => 'USB-C',
                                'charging_time' => '50 minutes',
                                'coil_type' => 'Replaceable SX Coils (0.8Ω MTL, 0.6Ω RDL)',
                                'pod_capacity' => '4ml (Refillable)',
                                'power_range' => '10-25W (Adjustable)',
                                'activation' => 'Button Fire',
                                'display' => 'LED Battery Indicator',
                                'features' => ['Adjustable Wattage', 'Leak-Proof Design', 'Overcharge Protection'],
                                'weight' => '65g',
                                'in_the_box' => '1x Device, 1x 0.8Ω Pod, 1x 0.6Ω Pod, 1x USB-C Cable, User Manual'
                            ]
                        ],
                        [
                            'name' => 'SmokeX Lite',
                            'release_year' => 2024,
                            'price_range' => '220 - 280 EGP',
                            'available_colors' => ['Arctic White', 'Midnight Purple', 'Sunset Orange', 'Rose Gold'],
                            'available_flavors' => [],
                            'specs' => [
                                'battery_capacity' => '600mAh',
                                'charging_port' => 'USB-C',
                                'charging_time' => '40 minutes',
                                'coil_type' => 'Integrated 1.2Ω Coil (Non-Replaceable)',
                                'pod_capacity' => '2ml (Refillable)',
                                'power_output' => 'Fixed 12W Output',
                                'activation' => 'Auto-Draw Only',
                                'display' => 'Single LED Indicator',
                                'features' => ['Ultra-Compact', 'Beginner-Friendly', 'Pocket-Sized'],
                                'weight' => '28g',
                                'in_the_box' => '1x Device, 1x Pod, 1x USB-C Cable, User Manual'
                            ]
                        ],
                        [
                            'name' => 'SmokeX Pro Max',
                            'release_year' => 2024,
                            'price_range' => '550 - 650 EGP',
                            'available_colors' => ['Gunmetal Grey', 'Royal Blue', 'Bronze', 'Chrome Silver'],
                            'available_flavors' => [],
                            'specs' => [
                                'battery_capacity' => '1500mAh',
                                'charging_port' => 'USB-C',
                                'charging_time' => '75 minutes',
                                'coil_type' => 'Replaceable Pro Coils (0.4Ω DTL, 0.8Ω MTL, 1.0Ω Tight MTL)',
                                'pod_capacity' => '5ml (Refillable)',
                                'power_range' => '5-30W (Adjustable)',
                                'activation' => 'Auto-Draw & Button Fire',
                                'display' => '0.69" OLED Screen (Wattage, Battery, Resistance)',
                                'features' => ['Advanced Chipset', 'Temperature Control', 'Customizable Curves', 'Airflow Control'],
                                'weight' => '85g',
                                'in_the_box' => '1x Device, 1x 0.4Ω Pod, 1x 0.8Ω Pod, 1x 1.0Ω Pod, 1x USB-C Cable, User Manual'
                            ]
                        ],
                        [
                            'name' => 'SmokeX Stick Pod',
                            'release_year' => 2023,
                            'price_range' => '200 - 250 EGP',
                            'available_colors' => ['Classic Black', 'Sky Blue', 'Ruby Red', 'Matte Silver'],
                            'available_flavors' => [],
                            'specs' => [
                                'battery_capacity' => '400mAh',
                                'charging_port' => 'Micro-USB',
                                'charging_time' => '60 minutes',
                                'coil_type' => 'Pre-filled Pod System (Closed) - 1.2Ω',
                                'pod_capacity' => '1.8ml (Pre-filled, Various Flavors)',
                                'power_output' => 'Fixed Output',
                                'activation' => 'Auto-Draw',
                                'display' => 'LED Tip Indicator',
                                'features' => ['JUUL-Alternative', 'Very Simple to Use', 'Discreet Design'],
                                'weight' => '20g (without pod)',
                                'in_the_box' => '1x Device, 1x Charger, User Manual'
                            ]
                        ],
                        [
                            'name' => 'SmokeX Air',
                            'release_year' => 2024,
                            'price_range' => '320 - 380 EGP',
                            'available_colors' => ['Mist Grey', 'Aqua Blue', 'Coral Pink', 'Lavender'],
                            'available_flavors' => [],
                            'specs' => [
                                'battery_capacity' => '900mAh',
                                'charging_port' => 'USB-C',
                                'charging_time' => '45 minutes',
                                'coil_type' => 'Replaceable Air Coils (0.7Ω Mesh)',
                                'pod_capacity' => '3.5ml (Refillable)',
                                'power_output' => 'Auto-Adjusting 18W',
                                'activation' => 'Auto-Draw Only',
                                'display' => '3-Color LED Battery Indicator',
                                'features' => ['Ergonomic Design', 'Leak-Resistant', 'Quick Charge'],
                                'weight' => '45g',
                                'in_the_box' => '1x Device, 2x 0.7Ω Pods, 1x USB-C Cable, User Manual'
                            ]
                        ],
                        [
                            'name' => 'SmokeX Cube',
                            'release_year' => 2023,
                            'price_range' => '480 - 550 EGP',
                            'available_colors' => ['Jet Black', 'Electric Blue', 'Blood Red', 'Cyber Green'],
                            'available_flavors' => [],
                            'specs' => [
                                'battery_capacity' => '1000mAh',
                                'charging_port' => 'USB-C',
                                'charging_time' => '55 minutes',
                                'coil_type' => 'Replaceable Cube Coils (0.5Ω Mesh RDL, 1.2Ω Regular MTL)',
                                'pod_capacity' => '4ml (Refillable)',
                                'power_range' => '12-25W (Adjustable)',
                                'activation' => 'Button Fire',
                                'display' => 'Small OLED Screen (Battery, Wattage, Puff Counter)',
                                'features' => ['Square Design', 'Comfortable Grip', 'Multiple Safety Protections'],
                                'weight' => '70g',
                                'in_the_box' => '1x Device, 1x 0.5Ω Pod, 1x 1.2Ω Pod, 1x USB-C Cable, User Manual'
                            ]
                        ]
                    ],
                ]
            ]
        ],

        'VapeEgypt' => [
            'country' => 'Egypt',
            'website' => 'https://vapeegypt.net',
            'description' => 'An Egyptian brand focusing on both beginner-friendly devices and advanced mod kits.',
            'categories' => [
                [
                    'name' => 'Disposable',
                    'devices' => [
                        [
                            'name' => 'VapeEgypt Nile 1500',
                            'release_year' => 2024,
                            'price_range' => '140 - 170 EGP',
                            'available_colors' => [],
                            'available_flavors' => ['Mint', 'Double Apple', 'Watermelon', 'Mango', 'Strawberry', 'Tobacco'],
                            'puffs' => 1500,
                            'nicotine_type' => 'MTL',
                            'nicotine_strength' => ['25mg/ml (2.5%)'],
                            'ice_type' => 'Non-Ice', // Added ice type
                            'specs' => [
                                'puff_count' => '~1500 Puffs',
                                'battery_capacity' => '850mAh (Integrated, Non-Rechargeable)',
                                'e_liquid_capacity' => '4ml',
                                'coil_type' => 'Standard Wick Coil',
                                'charge_port' => 'None',
                                'activation' => 'Draw-Activated',
                                'features' => ['Compact Design', 'Pocket-Friendly'],
                                'weight' => '30g'
                            ]
                        ],
                    ],
                ],
                [
                'name' => 'Pod System',
                'devices' => [
                    [
                        'name' => 'VapeEgypt Nile Pro Pod',
                        'release_year' => 2023,
                        'price_range' => '320 - 380 EGP',
                        'available_colors' => ['Nile Blue', 'Desert Gold', 'Pyramid White', 'Pharaoh Black'],
                        'available_flavors' => [],
                        'specs' => [
                            'battery_capacity' => '800mAh',
                            'charging_port' => 'USB-C',
                            'charging_time' => '45 minutes',
                            'coil_type' => 'Replaceable VE Pods (0.8Ω MTL, 0.6Ω RDL)',
                            'pod_capacity' => '3ml (Refillable)',
                            'power_output' => 'Auto-Adjusting 15-20W',
                            'activation' => 'Auto-Draw & Button Fire',
                            'display' => '3-LED Battery Indicator',
                            'features' => ['Leak-Resistant Design', 'Fast Charging', 'Overcharge Protection'],
                            'weight' => '42g',
                            'in_the_box' => '1x Device, 1x 0.8Ω Pod, 1x 0.6Ω Pod, 1x USB-C Cable, User Manual'
                        ]
                    ],
                    [
                        'name' => 'VapeEgypt Delta Pod Kit',
                        'release_year' => 2024,
                        'price_range' => '450 - 520 EGP',
                        'available_colors' => ['Carbon Black', 'Stainless Steel', 'Royal Blue', 'Emerald Green'],
                        'available_flavors' => [],
                        'specs' => [
                            'battery_capacity' => '1200mAh',
                            'charging_port' => 'USB-C',
                            'charging_time' => '60 minutes',
                            'coil_type' => 'Replaceable Delta Coils (0.4Ω DTL, 0.8Ω MTL, 1.0Ω Tight MTL)',
                            'pod_capacity' => '4.5ml (Refillable)',
                            'power_range' => '5-30W (Adjustable)',
                            'activation' => 'Button Fire',
                            'display' => '0.69" OLED Screen',
                            'features' => ['Adjustable Airflow', 'Wattage Control', 'Puff Counter', 'Safety Protections'],
                            'weight' => '75g',
                            'in_the_box' => '1x Device, 1x 0.4Ω Pod, 1x 0.8Ω Pod, 1x USB-C Cable, User Manual'
                        ]
                    ],
                    [
                        'name' => 'VapeEgypt Mini Pod',
                        'release_year' => 2024,
                        'price_range' => '220 - 280 EGP',
                        'available_colors' => ['Rose Gold', 'Arctic Silver', 'Midnight Black', 'Ocean Blue'],
                        'available_flavors' => [],
                        'specs' => [
                            'battery_capacity' => '600mAh',
                            'charging_port' => 'USB-C',
                            'charging_time' => '40 minutes',
                            'coil_type' => 'Integrated 1.2Ω Coil',
                            'pod_capacity' => '2ml (Refillable)',
                            'power_output' => 'Fixed 12W Output',
                            'activation' => 'Auto-Draw Only',
                            'display' => 'Single LED Indicator',
                            'features' => ['Ultra-Compact', 'Beginner-Friendly', 'Pocket-Sized Design'],
                            'weight' => '30g',
                            'in_the_box' => '1x Device, 1x Pod, 1x USB-C Cable, User Manual'
                        ]
                    ],
                    [
                        'name' => 'VapeEgypt Alpha Pod Mod',
                        'release_year' => 2023,
                        'price_range' => '580 - 650 EGP',
                        'available_colors' => ['Gunmetal', 'Bronze', 'Chrome', 'Matte Black'],
                        'available_flavors' => [],
                        'specs' => [
                            'battery_capacity' => '1500mAh',
                            'charging_port' => 'USB-C',
                            'charging_time' => '75 minutes',
                            'coil_type' => 'Replaceable Alpha Coils (0.3Ω DTL, 0.6Ω RDL, 0.8Ω MTL)',
                            'pod_capacity' => '5ml (Refillable)',
                            'power_range' => '5-40W (Adjustable)',
                            'activation' => 'Auto-Draw & Button Fire',
                            'display' => '0.96" Color Screen',
                            'features' => ['Advanced Chipset', 'Temperature Control', 'Custom Curves', 'RGB Lighting'],
                            'weight' => '90g',
                            'in_the_box' => '1x Device, 1x 0.3Ω Pod, 1x 0.6Ω Pod, 1x 0.8Ω Pod, 1x USB-C Cable, User Manual'
                        ]
                    ],
                    [
                        'name' => 'VapeEgypt Flex Pod',
                        'release_year' => 2024,
                        'price_range' => '350 - 420 EGP',
                        'available_colors' => ['Sapphire Blue', 'Ruby Red', 'Emerald Green', 'Amethyst Purple'],
                        'available_flavors' => [],
                        'specs' => [
                            'battery_capacity' => '1000mAh',
                            'charging_port' => 'USB-C',
                            'charging_time' => '50 minutes',
                            'coil_type' => 'Replaceable Flex Coils (0.7Ω Mesh)',
                            'pod_capacity' => '3.5ml (Refillable)',
                            'power_output' => 'Auto-Adjusting 18W',
                            'activation' => 'Auto-Draw Only',
                            'display' => '3-Color LED Indicator',
                            'features' => ['Ergonomic Design', 'Leak-Proof', 'Quick Charge', 'Portable'],
                            'weight' => '48g',
                            'in_the_box' => '1x Device, 2x 0.7Ω Pods, 1x USB-C Cable, User Manual'
                        ]
                    ],
                    [
                        'name' => 'VapeEgypt Stick Pod',
                        'release_year' => 2023,
                        'price_range' => '180 - 240 EGP',
                        'available_colors' => ['Classic Black', 'White Pearl', 'Blue Steel', 'Red Crimson'],
                        'available_flavors' => [],
                        'specs' => [
                            'battery_capacity' => '400mAh',
                            'charging_port' => 'Micro-USB',
                            'charging_time' => '60 minutes',
                            'coil_type' => 'Pre-filled Pod System (1.2Ω)',
                            'pod_capacity' => '1.8ml (Pre-filled, Various Flavors)',
                            'power_output' => 'Fixed Output',
                            'activation' => 'Auto-Draw',
                            'display' => 'LED Tip Light',
                            'features' => ['Simple Design', 'Easy to Use', 'Discreet'],
                            'weight' => '22g (without pod)',
                            'in_the_box' => '1x Device, 1x Charger, User Manual'
                        ]
                    ],
                    [
                        'name' => 'VapeEgypt Cube Pod',
                        'release_year' => 2024,
                        'price_range' => '380 - 450 EGP',
                        'available_colors' => ['Jet Black', 'Electric Blue', 'Blood Red', 'Cyber Green'],
                        'available_flavors' => [],
                        'specs' => [
                            'battery_capacity' => '900mAh',
                            'charging_port' => 'USB-C',
                            'charging_time' => '55 minutes',
                            'coil_type' => 'Replaceable Cube Coils (0.5Ω RDL, 1.0Ω MTL)',
                            'pod_capacity' => '3ml (Refillable)',
                            'power_range' => '10-25W (Adjustable)',
                            'activation' => 'Button Fire',
                            'display' => 'Small OLED Screen',
                            'features' => ['Square Design', 'Comfortable Grip', 'Safety Features'],
                            'weight' => '65g',
                            'in_the_box' => '1x Device, 1x 0.5Ω Pod, 1x 1.0Ω Pod, 1x USB-C Cable, User Manual'
                        ]
                    ],
                    [
                        'name' => 'VapeEgypt Ultra Slim Pod',
                        'release_year' => 2024,
                        'price_range' => '260 - 320 EGP',
                        'available_colors' => ['Champagne Gold', 'Platinum Silver', 'Onyx Black', 'Rose Pink'],
                        'available_flavors' => [],
                        'specs' => [
                            'battery_capacity' => '500mAh',
                            'charging_port' => 'USB-C',
                            'charging_time' => '35 minutes',
                            'coil_type' => 'Integrated 1.5Ω Coil',
                            'pod_capacity' => '1.5ml (Refillable)',
                            'power_output' => 'Fixed 10W Output',
                            'activation' => 'Auto-Draw Only',
                            'display' => 'Mini LED Indicator',
                            'features' => ['Ultra-Slim Design', 'Lightweight', 'Discreet', 'Portable'],
                            'weight' => '25g',
                            'in_the_box' => '1x Device, 1x Pod, 1x USB-C Cable, User Manual'
                        ]
                    ]
                ],
                ],
                [
            'name' => 'Box Mod',
            'devices' => [
                [
                    'name' => 'VapeEgypt Pharaoh 220W TC Box Mod',
                    'release_year' => 2023,
                    'price_range' => '1,200 - 1,500 EGP (Device Only)',
                    'available_colors' => ['Bronze', 'Black', 'Gunmetal', 'Stainless Steel'],
                    'available_flavors' => [],
                    'specs' => [
                        'battery_type' => 'Dual 18650 (Sold Separately)',
                        'external_battery' => true,
                        'power_range' => '5-220W',
                        'temp_control' => 'Ni200, Titanium, Stainless Steel, TCR',
                        'display' => '0.96" Monochrome LCD Screen',
                        'resistance_range' => '0.05-3.0Ω',
                        'charging_port' => 'Micro-USB (5V/1A)',
                        'chipset' => 'VapeEgypt V1 with Overcharge/Overheat Protection',
                        'features' => ['Wattage Curves', 'Bypass Mode', 'Zinc-Alloy Construction'],
                        'height' => '130mm',
                        'in_the_box' => '1x Mod, 1x USB Cable, User Manual, Warranty Card'
                    ]
                ],
                [
                    'name' => 'VapeEgypt Pyramid 100W Box Mod',
                    'release_year' => 2024,
                    'price_range' => '900 - 1,100 EGP (Device Only)',
                    'available_colors' => ['Sandstone', 'Onyx Black', 'Desert Gold', 'Marble White'],
                    'available_flavors' => [],
                    'specs' => [
                        'battery_type' => 'Single 21700/18650 (Sold Separately)',
                        'external_battery' => true,
                        'power_range' => '5-100W',
                        'temp_control' => 'Ni200, SS316, TCR',
                        'display' => '0.69" OLED Screen',
                        'resistance_range' => '0.1-3.0Ω',
                        'charging_port' => 'USB-C (2A Fast Charging)',
                        'chipset' => 'VapeEgypt Mini Chip',
                        'features' => ['Compact Design', 'Lightweight', 'Pocket-Friendly'],
                        'height' => '95mm',
                        'in_the_box' => '1x Mod, 1x USB-C Cable, User Manual'
                    ]
                ],
                [
                    'name' => 'VapeEgypt Obelisk 300W Pro Mod',
                    'release_year' => 2024,
                    'price_range' => '1,800 - 2,200 EGP (Device Only)',
                    'available_colors' => ['Titanium', 'Carbon Fiber', 'Brushed Steel', 'Copper'],
                    'available_flavors' => [],
                    'specs' => [
                        'battery_type' => 'Dual 21700/18650 (Sold Separately)',
                        'external_battery' => true,
                        'power_range' => '5-300W',
                        'temp_control' => 'Ni200, Ti, SS, NiCr, TCR, TFR',
                        'display' => '1.3" Color TFT Screen',
                        'resistance_range' => '0.05-5.0Ω',
                        'charging_port' => 'USB-C (3A Balanced Charging)',
                        'chipset' => 'VapeEgypt Pro Chipset',
                        'features' => ['Bluetooth Connectivity', 'Firmware Upgradable', 'Custom Themes', 'RGB Lighting'],
                        'height' => '145mm',
                        'in_the_box' => '1x Mod, 1x USB-C Cable, User Manual, Warranty Card'
                    ]
                ],
                [
                    'name' => 'VapeEgypt Scarab 80W Squonk Mod',
                    'release_year' => 2023,
                    'price_range' => '1,100 - 1,400 EGP (Device Only)',
                    'available_colors' => ['Matte Black', 'Blue Resin', 'Red Resin', 'Green Resin'],
                    'available_flavors' => [],
                    'specs' => [
                        'battery_type' => 'Single 21700/18650 (Sold Separately)',
                        'external_battery' => true,
                        'power_range' => '5-80W',
                        'temp_control' => 'Ni200, SS316, TCR',
                        'squonk_bottle_capacity' => '8ml (Silicone)',
                        'display' => '0.96" OLED Screen',
                        'resistance_range' => '0.1-3.0Ω',
                        'charging_port' => 'USB-C (2A Charging)',
                        'chipset' => 'VapeEgypt Squonk Chip',
                        'features' => ['Bottom-Feeding System', 'Leak-Proof Design', 'Lightweight'],
                        'height' => '105mm',
                        'in_the_box' => '1x Mod, 1x Squonk Bottle, 1x USB-C Cable, User Manual'
                    ]
                ]
            ],
                ],
                [
                    'name' => 'Starter Kit',
                    'devices' => [
                        [
                            'name' => 'VapeEgypt Nile Complete Kit',
                            'release_year' => 2023,
                            'price_range' => '1,800 - 2,200 EGP (Full Kit)',
                            'available_colors' => ['Kit Black', 'Kit Blue', 'Kit Red'],
                            'available_flavors' => [],
                            'specs' => [
                                'kit_includes' => 'Pharaoh 80W Mod + Horizon Tank',
                                'tank_capacity' => '4ml (Standard) / 2ml (TPD)',
                                'coil_options' => '0.2Ω Mesh (60-70W), 0.4Ω Mesh (50-60W)',
                                'battery_type' => 'Requires 1x 18650 (Not Included)',
                                'power_range' => '5-80W',
                                'display' => '0.96" LCD Screen',
                                'charging_port' => 'Micro-USB',
                                'features' => 'Top Fill, Adjustable Bottom Airflow, Spare Glass',
                                'in_the_box' => '1x Mod, 1x Tank, 1x 0.2Ω Coil, 1x 0.4Ω Coil, Spare Parts, USB Cable, Manual'
                            ]
                        ],
                        [
                            'name' => 'VapeEgypt Beginner Pro Kit',
                            'release_year' => 2024,
                            'price_range' => '1,500 - 1,800 EGP (Full Kit)',
                            'available_colors' => ['Starter Blue', 'Beginner Black', 'Pro Silver'],
                            'available_flavors' => [],
                            'specs' => [
                                'kit_includes' => 'Pyramid 100W Mod + Clearo Tank',
                                'tank_capacity' => '5ml (Standard)',
                                'coil_options' => '0.3Ω Mesh (40-50W), 0.6Ω Mesh (25-35W)',
                                'battery_type' => 'Requires 1x 21700/18650 (Not Included)',
                                'power_range' => '5-100W',
                                'display' => '0.69" OLED Screen',
                                'charging_port' => 'USB-C',
                                'features' => 'Beginner-Friendly, Simple Interface, Safety Features',
                                'in_the_box' => '1x Mod, 1x Tank, 2x Coils, Spare Glass, USB Cable, Manual, Beginner Guide'
                            ]
                        ],
                        [
                            'name' => 'VapeEgypt Advanced Master Kit',
                            'release_year' => 2024,
                            'price_range' => '2,500 - 3,000 EGP (Full Kit)',
                            'available_colors' => ['Master Black', 'Pro Gold', 'Expert Silver'],
                            'available_flavors' => [],
                            'specs' => [
                                'kit_includes' => 'Obelisk 300W Mod + Subohm Pro Tank',
                                'tank_capacity' => '6ml (Standard)',
                                'coil_options' => '0.15Ω Quad Mesh (80-120W), 0.2Ω Triple Mesh (70-100W), 0.4Ω Single Mesh (50-70W)',
                                'battery_type' => 'Requires 2x 21700/18650 (Not Included)',
                                'power_range' => '5-300W',
                                'display' => '1.3" Color TFT Screen',
                                'charging_port' => 'USB-C',
                                'features' => 'Advanced Features, Temperature Control, Customization Options',
                                'in_the_box' => '1x Mod, 1x Tank, 3x Coils, Spare Glass, Tools, USB Cable, Comprehensive Manual'
                            ]
                        ],
                        [
                            'name' => 'VapeEgypt MTL Starter Kit',
                            'release_year' => 2023,
                            'price_range' => '1,200 - 1,500 EGP (Full Kit)',
                            'available_colors' => ['MTL Black', 'Classic Silver', 'Traditional Bronze'],
                            'available_flavors' => [],
                            'specs' => [
                                'kit_includes' => 'Compact 60W Mod + MTL Tank',
                                'tank_capacity' => '3ml (Standard)',
                                'coil_options' => '0.8Ω MTL (15-20W), 1.0Ω MTL (12-16W), 1.2Ω Tight MTL (10-14W)',
                                'battery_type' => 'Built-in 2500mAh Battery',
                                'power_range' => '5-60W',
                                'display' => '0.69" OLED Screen',
                                'charging_port' => 'USB-C',
                                'features' => 'MTL Focused, Tight Draw, Nicotine Salt Optimized',
                                'in_the_box' => '1x Mod, 1x Tank, 3x Coils, Spare Glass, USB Cable, Manual, MTL Guide'
                            ]
                        ],
                        [
                            'name' => 'VapeEgypt Squonk Starter Kit',
                            'release_year' => 2024,
                            'price_range' => '1,700 - 2,000 EGP (Full Kit)',
                            'available_colors' => ['Squonk Black', 'Resin Blue', 'Resin Red'],
                            'available_flavors' => [],
                            'specs' => [
                                'kit_includes' => 'Scarab 80W Squonk Mod + RDA',
                                'rda_type' => 'Single Coil BF RDA',
                                'squonk_bottle_capacity' => '8ml',
                                'coil_options' => 'Build Your Own (Not Included)',
                                'battery_type' => 'Requires 1x 21700/18650 (Not Included)',
                                'power_range' => '5-80W',
                                'display' => '0.96" OLED Screen',
                                'charging_port' => 'USB-C',
                                'features' => 'Squonk System, Bottom Feeding, RDA Included',
                                'in_the_box' => '1x Mod, 1x RDA, 1x Squonk Bottle, Tools, USB Cable, Building Manual'
                            ]
                        ]
                    ],
                ],
                [ 
                'name' => 'Pod Mod',
                'devices' => [
                    [
                        'name' => 'VapeEgypt Apex 80W Pod Mod',
                        'release_year' => 2024,
                        'price_range' => '850 - 950 EGP',
                        'available_colors' => ['Resin Black', 'Resin Blue', 'Resin Red', 'Stainless Steel'],
                        'available_flavors' => [],
                        'specs' => [
                            'battery_type' => 'External 18650 (Single, Not Included)',
                            'max_power' => '80W',
                            'charging_port' => 'USB-C',
                            'coil_type' => 'Replaceable Apex Coils (0.15Ω Mesh DTL, 0.3Ω Mesh RDL, 0.6Ω MTL)',
                            'pod_tank_capacity' => '5.5ml (Refillable)',
                            'power_range' => '5-80W (Adjustable)',
                            'activation' => 'Button Fire',
                            'display' => '0.96" TFT Color Screen',
                            'features' => ['Variable Wattage', 'Bypass Mode', 'Comprehensive Safety Protections', 'Customizable UI', 'Adjustable Airflow Control'],
                            'weight' => '110g (Without Battery)',
                            'in_the_box' => '1x Device, 1x 0.3Ω Pod, 1x 0.6Ω Pod, 1x USB-C Cable, User Manual'
                        ]
                    ],
                    [
                        'name' => 'VapeEgypt Pharaoh Pro Pod Mod Kit',
                        'release_year' => 2023,
                        'price_range' => '720 - 800 EGP',
                        'available_colors' => ['Bronze', 'Gold', 'Sandstone', 'Obsidian'],
                        'available_flavors' => [],
                        'specs' => [
                            'battery_capacity' => 'Integrated 2500mAh',
                            'max_power' => '60W',
                            'charging_port' => 'USB-C',
                            'charging_time' => '90 minutes',
                            'coil_type' => 'Replaceable Pharaoh Coils (0.25Ω DTL, 0.5Ω RDL, 1.2Ω MTL)',
                            'pod_tank_capacity' => '4ml (Refillable)',
                            'power_range' => '5-60W (Adjustable)',
                            'activation' => 'Auto-Draw & Button Fire',
                            'display' => '0.69" OLED Screen',
                            'features' => ['Smart Wattage Recommendation', 'Puff Counter & Timer', 'RGB Accent Lighting', 'Leak-Resistant Design'],
                            'weight' => '150g',
                            'in_the_box' => '1x Device, 1x 0.25Ω Pod, 1x 1.2Ω Pod, 1x USB-C Cable, User Manual'
                        ]
                    ],
                    [
                        'name' => 'VapeEgypt Dualis Dual Battery Pod Mod',
                        'release_year' => 2024,
                        'price_range' => '1200 - 1400 EGP',
                        'available_colors' => ['Carbon Fiber', 'Matte Black', 'Prism Chrome', 'Camouflage'],
                        'available_flavors' => [],
                        'specs' => [
                            'battery_type' => 'External 18650 (Dual, Not Included)',
                            'max_power' => '200W',
                            'charging_port' => 'USB-C (Balance Charging)',
                            'coil_type' => 'Replaceable Dualis Coils (0.1Ω Quad DTL, 0.2Ω Dual DTL) & RBA Deck Optional',
                            'pod_tank_capacity' => '6ml (Refillable)',
                            'power_range' => '5-200W (Adjustable)',
                            'activation' => 'Button Fire',
                            'display' => '1.3" Full-Color IPS Screen',
                            'features' => ['Advanced Temperature Control Suite', 'User-Defined Power Curves', 'Dual Battery Indicator', 'Durable Zinc-Alloy Frame', 'Massive Cloud Production'],
                            'weight' => '250g (Without Batteries)',
                            'in_the_box' => '1x Device, 1x 0.1Ω Pod, 1x 0.2Ω Pod, 1x USB-C Cable, User Manual'
                        ]
                    ],
                    [
                        'name' => 'VapeEgypt Nexus AIO Pod Mod',
                        'release_year' => 2024,
                        'price_range' => '500 - 580 EGP',
                        'available_colors' => ['Slate Grey', 'Midnight Purple', 'Forest Green', 'Crimson Red'],
                        'available_flavors' => [],
                        'specs' => [
                            'battery_capacity' => 'Integrated 1600mAh',
                            'max_power' => '40W',
                            'charging_port' => 'USB-C',
                            'charging_time' => '75 minutes',
                            'coil_type' => 'Replaceable Nexus Coils (0.6Ω RDL, 0.8Ω MTL) & Compatible with VE Pods',
                            'pod_tank_capacity' => '3.5ml (Refillable)',
                            'power_range' => '10-40W (Adjustable)',
                            'activation' => 'Button Fire',
                            'display' => 'Simple LED Power Indicator',
                            'features' => ['All-in-One Design', 'Compact Form Factor', 'Beginner to Intermediate', 'Wide Airflow Control'],
                            'weight' => '85g',
                            'in_the_box' => '1x Device, 1x 0.6Ω Pod, 1x 0.8Ω Pod, 1x USB-C Cable, User Manual'
                        ]
                    ]
                    ],
                ]
            ]
        ],

    'Pyramid' => [
        'country' => 'Egypt',
        'website' => null,
        'description' => 'A budget-friendly Egyptian brand dominating the disposable and simple pod market.',
        'categories' => [
            [
                'name' => 'Disposable',
                'devices' => [
                    [
                        'name' => 'Pyramid 3000 Puff Disposable',
                        'release_year' => 2023,
                        'price_range' => '200 - 250 EGP',
                        'available_colors' => [],
                        'available_flavors' => ['Grape Ice', 'Energy Drink', 'Peach Mango', 'Menthol', 'Blueberry Ice', 'Lemon Tart'],
                        'puffs' => 3000,
                        'nicotine_type' => 'MTL',
                        'nicotine_strength' => ['50mg/ml (5%)'],
                        'ice_type' => 'Ice', // Added ice type
                        'specs' => [
                            'puff_count' => '~3000 Puffs',
                            'battery_capacity' => '1000mAh (Integrated, Rechargeable)',
                            'e_liquid_capacity' => '8ml',
                            'coil_type' => 'Mesh Coil',
                            'charge_port' => 'USB-C (Included)',
                            'activation' => 'Draw-Activated',
                            'features' => ['Compact Design', 'Wide Flavor Range'],
                            'weight' => '50g'
                        ]
                    ],
                ],
            ],
        ]
    ],

    // Chinese Brands
    'SMOK' => [
        'country' => 'China',
        'website' => 'https://www.smoktech.com',
        'description' => 'One of the most popular and widely available vape brands globally.',
        'categories' => [
            [
                'name' => 'Disposable',
                'devices' => [
                    [
                        'name' => 'SMOK Spaceman 10K Pro',
                        'release_year' => 2023,
                        'price_range' => '$15 - $20',
                        'available_colors' => [],
                        'available_flavors' => ['Blue Razz Ice', 'Strawberry Watermelon', 'Mango Peach', 'Lush Ice', 'Pineapple Lemonade', 'Tobacco', 'Menthol'],
                        'puffs' => 10000,
                        'nicotine_type' => 'DTL',
                        'nicotine_strength' => ['50mg/ml (5%)'],
                        'ice_type' => 'Ice', // Added ice type
                        'specs' => [
                            'puff_count' => '~10000 Puffs',
                            'battery_capacity' => '1000mAh (Rechargeable)',
                            'e_liquid_capacity' => '18ml',
                            'coil_type' => 'Mesh Coil',
                            'charge_port' => 'USB-C',
                            'display' => 'E-liquid & Battery LED Indicator',
                            'features' => ['Draw-Activated', 'Mesh Coil', 'Rechargeable'],
                            'weight' => '85g'
                        ]
                    ],
                ]
            ],
        ]
    ],

    // Disposable-Focused Brands
    'Elf Bar' => [
        'country' => 'China',
        'website' => 'https://www.elfbar.com',
        'description' => 'The most recognized disposable vape brand worldwide.',
        'categories' => [
            [
                'name' => 'Disposable',
                'devices' => [
                    [
                        'name' => 'Elf Bar BC5000 Ultra',
                        'release_year' => 2023,
                        'price_range' => '$15 - $20',
                        'available_colors' => [],
                        'available_flavors' => ['Blue Razz Ice', 'Strawberry Kiwi', 'Watermelon Bubblegum', 'Mango Peach', 'Pink Lemonade', 'Energy', 'Tropical Rainbow Blast', 'Cotton Candy'],
                        'puffs' => 5000,
                        'nicotine_type' => 'RDL',
                        'nicotine_strength' => ['50mg/ml (5%)' , '20mg/ml (2%)'],
                        'ice_type' => 'Ice', // Added ice type
                        'specs' => [
                            'puff_count' => '~5000 Puffs',
                            'battery_capacity' => '650mAh (Rechargeable)',
                            'e_liquid_capacity' => '13ml',
                            'coil_type' => 'Mesh Coil',
                            'charge_port' => 'USB-C',
                            'display' => 'E-Liquid Level Indicator',
                            'features' => ['Draw-Activated', 'Mesh Coil', 'Rechargeable'],
                            'weight' => '55g'
                        ]
                    ],
                    [
                        'name' => 'Elf Bar 600',
                        'release_year' => 2021,
                        'price_range' => '$8 - $12',
                        'available_colors' => [],
                        'available_flavors' => ['Blueberry', 'Strawberry Ice', 'Mango', 'Cola', 'Tobacco', 'Menthol', 'Apple Peach', 'Grape'],
                        'puffs' => 600,
                        'nicotine_type' => 'MTL',
                        'nicotine_strength' => ['20mg/ml (2%)'],
                        'ice_type' => 'Mixed', // Added ice type (some flavors have ice, some don't)
                        'specs' => [
                            'puff_count' => '~600 Puffs',
                            'battery_capacity' => '550mAh (Non-Rechargeable)',
                            'e_liquid_capacity' => '2ml',
                            'coil_type' => 'Standard Coil',
                            'charge_port' => 'None',
                            'activation' => 'Draw-Activated',
                            'features' => ['Compact', 'Lightweight', 'Disposable'],
                            'weight' => '25g'
                        ]
                    ],
                ]
            ],
        ]
    ],

    'Hyde' => [
        'country' => 'United States',
        'website' => 'https://hydevape.com',
        'description' => 'A major American disposable vape brand.',
        'categories' => [
            [
                'name' => 'Disposable',
                'devices' => [
                    [
                        'name' => 'Hyde Rebel Recharge',
                        'release_year' => 2023,
                        'price_range' => '$14 - $18',
                        'available_colors' => [],
                        'available_flavors' => ['Mango Peach', 'Rainbow Drop', 'Blue Razz', 'Strawberry Banana', 'Lush Ice', 'Pineapple Orange', 'Gummy Bear'],
                        'puffs' => 5000,
                        'nicotine_type' => 'RDL',
                        'nicotine_strength' => ['50mg/ml (5%)'],
                        'ice_type' => 'Mixed', // Added ice type (some flavors have ice, some don't)
                        'specs' => [
                            'puff_count' => '~5000 Puffs',
                            'battery_capacity' => '650mAh (Rechargeable)',
                            'e_liquid_capacity' => '12ml',
                            'coil_type' => 'Mesh Coil',
                            'charge_port' => 'USB-C',
                            'display' => 'LED Battery Indicator',
                            'features' => ['Draw-Activated', 'Mesh Coil', 'Rechargeable'],
                            'weight' => '60g'
                        ]
                    ],
                    [
                        'name' => 'Hyde Edge Rave',
                        'release_year' => 2022,
                        'price_range' => '$10 - $15',
                        'available_colors' => [],
                        'available_flavors' => ['Berry Blast', 'Peach Mango', 'Blueberry Ice', 'Strawberry Kiwi', 'Watermelon', 'Mint'],
                        'puffs' => 4000,
                        'nicotine_type' => 'MTL',
                        'nicotine_strength' => ['50mg/ml (5%)'],
                        'ice_type' => 'Mixed', // Added ice type (some flavors have ice, some don't)
                        'specs' => [
                            'puff_count' => '~4000 Puffs',
                            'battery_capacity' => '600mAh (Rechargeable)',
                            'e_liquid_capacity' => '10ml',
                            'coil_type' => 'Mesh Coil',
                            'charge_port' => 'USB-C',
                            'features' => ['Draw-Activated', 'Colorful Design', 'Rechargeable'],
                            'weight' => '50g'
                        ]
                    ],
                ]
            ],
        ]
    ],
];
        
        foreach ($brands as $brandName => $brandData) {
            // Insert brand
            $device_brand = DeviceBrands::firstOrCreate([
                'name' => $brandName,
                'country' => $brandData['country'],
                'website'=> $brandData['website'],
                'description'=>$brandData['description']
            ]);

            // Loop categories
            foreach ($brandData['categories'] as $category) {
                // Insert/find category
                $deviceCategory = DevicesCategories::firstOrCreate(
                    ['name' => $category['name']]
                );

                // Loop devices
                foreach ($category['devices'] as $device) {
                    $deviceModel = Devices::firstOrCreate([
                        'brand_id'     => $device_brand->id,
                        'category_id'  => $deviceCategory->id,
                        'name'         => $device['name'],
                        'release_year' => $device['release_year']
                    ]);
                    $deviceColors = $device['available_colors']??[];
                    foreach($deviceColors as $color){
                        DeviceColors::create(['name'=>$color , 'device_id'=>$deviceModel->id]);
                    }
                    $deviceFlavors = $device['available_flavors']??[];
                    foreach($deviceFlavors as $flavor){
                        $flavor = Component::firstOrCreate(['name'=>$flavor , 'category_id'=>1]);
                        DeviceFlavors::create(['component_id'=>$flavor->id , 'device_id'=>$deviceModel->id]);
                    }
                    // FOR Disposable
                    $puffs = $device['puffs']??null;
                    $nicotine_type = $device['nicotine_type']??null;
                    $nicotine_strengths = $device['nicotine_strength']??[];
                    $nicotine_ice = $device['ice_type']??null  ; 
                    foreach($nicotine_strengths as $nicotine_strength){
                        DevicePuffs::create(['device_id'=>$deviceModel->id , 
                        'value'=>$puffs , 'nicotine_strength'=>$nicotine_strength , 'nicotine_type'=>$nicotine_type,
                        'ice_type'=>$nicotine_ice]);
                    }
                    
                    // Loop specs
                    foreach ($device['specs'] as $specKey => $specValue) {
                        // Check if this is the 'features' array
                        if ($specKey === 'features' && is_array($specValue)) {
                            // Insert each feature individually
                            foreach ($specValue as $feature) {
                                DeviceFeatures::firstOrCreate([
                                    'name' => $feature,
                                    'device_id' => $deviceModel->id
                                ]);
                            }
                        } 
                        // For all other string/non-array specs
                        else {
                            DevicesSpecs::firstOrCreate([
                                'device_id'  => $deviceModel->id,
                                'spec_key'   => $specKey,
                                'spec_value' => $specValue
                            ]);
                        }
                                }
                            }
                        }
            }
    }
}
