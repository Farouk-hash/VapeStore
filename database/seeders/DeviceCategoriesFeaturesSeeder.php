<?php

namespace Database\Seeders;

use App\Models\Hardware\DeviceCategoriesFeatures;
use App\Models\Hardware\DevicesCategories;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeviceCategoriesFeaturesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categoriesWithFeatures = [
    [
        'category_name' => 'Pod System',
        
        'slug' => 'pod-system',
        'description' => 'Compact, user-friendly vaping devices with refillable pods. Perfect for beginners and those looking for a portable, low-maintenance vaping experience. Pod systems typically use replaceable coils and have integrated batteries.',
        'features' => [
            ['feature_key' => 'is_reusable', 'feature_value' => 'true', 'description' => 'Refillable and reusable hardware devices'],
            ['feature_key' => 'has_colors', 'feature_value' => 'true', 'description' => 'Hardware comes in different colors'],
            ['feature_key' => 'has_flavors', 'feature_value' => 'false', 'description' => 'Flavors are separate e-liquids, not device-specific'],
            ['feature_key' => 'requires_coils', 'feature_value' => 'true', 'description' => 'Uses replaceable coils'],
            ['feature_key' => 'is_refillable', 'feature_value' => 'true', 'description' => 'Pods can be refilled with e-liquid'],
            ['feature_key' => 'has_battery', 'feature_value' => 'true', 'description' => 'Contains integrated battery'],
            ['feature_key' => 'portability', 'feature_value' => 'high', 'description' => 'Designed for on-the-go use'],
            ['feature_key' => 'maintenance_level', 'feature_value' => 'low', 'description' => 'Easy to use and maintain'],
        ]
    ],
    [
        'category_name' => 'Disposable',
        'slug' => 'disposable',
        'description' => 'Pre-filled, single-use vaping devices that are ready to use right out of the package. No charging or refilling required - simply use until the e-liquid or battery runs out, then dispose of responsibly. Ideal for trying vaping or as a convenient backup.',
        'features' => [
            ['feature_key' => 'is_reusable', 'feature_value' => 'false', 'description' => 'Single-use devices'],
            ['feature_key' => 'has_colors', 'feature_value' => 'false', 'description' => 'Typically no color variations'],
            ['feature_key' => 'has_flavors', 'feature_value' => 'true', 'description' => 'Pre-filled with specific flavors'],
            ['feature_key' => 'requires_coils', 'feature_value' => 'false', 'description' => 'Integrated non-replaceable coils'],
            ['feature_key' => 'has_puff_count', 'feature_value' => 'true', 'description' => 'Advertised puff count'],
            ['feature_key' => 'is_prefilled', 'feature_value' => 'true', 'description' => 'Comes pre-filled with e-liquid'],
            ['feature_key' => 'is_compact', 'feature_value' => 'true', 'description' => 'Designed to be small and portable'],
            ['feature_key' => 'battery_included', 'feature_value' => 'true', 'description' => 'Comes with pre-charged battery'],
            ['feature_key' => 'setup_required', 'feature_value' => 'none', 'description' => 'Ready to use immediately'],
        ]
    ],
    [
        'category_name' => 'Box Mod',
        'slug' => 'box-mod',
        'description' => 'Advanced vaping devices offering maximum customization and power control. Box mods feature variable wattage/temperature settings, support external batteries, and are compatible with various tanks. Designed for experienced vapers who want full control over their vaping experience.',
        'features' => [
            ['feature_key' => 'is_reusable', 'feature_value' => 'true', 'description' => 'Advanced reusable hardware'],
            ['feature_key' => 'has_colors', 'feature_value' => 'true', 'description' => 'Comes in various colors'],
            ['feature_key' => 'has_flavors', 'feature_value' => 'false', 'description' => 'Flavors come from separate tanks/e-liquids'],
            ['feature_key' => 'requires_external_batteries', 'feature_value' => 'true', 'description' => 'Uses 18650/21700 batteries'],
            ['feature_key' => 'has_adjustable_wattage', 'feature_value' => 'true', 'description' => 'Variable wattage/temperature control'],
            ['feature_key' => 'has_screen', 'feature_value' => 'true', 'description' => 'Includes display screen'],
            ['feature_key' => 'is_advanced', 'feature_value' => 'true', 'description' => 'Designed for experienced vapers'],
            ['feature_key' => 'power_range', 'feature_value' => 'high', 'description' => 'High wattage output capabilities'],
            ['feature_key' => 'customization_options', 'feature_value' => 'extensive', 'description' => 'Multiple settings and modes'],
            ['feature_key' => 'tank_compatibility', 'feature_value' => 'universal', 'description' => 'Works with most 510-thread tanks'],
        ]
    ],
    [
        'category_name' => 'Starter Kit',
        'slug' => 'kits',
        'description' => 'Complete vaping packages designed specifically for beginners. Starter kits include everything needed to start vaping: device, tank, coils, and sometimes e-liquid samples. These kits prioritize ease of use, safety features, and straightforward operation to help new vapers get started confidently.',
        'features' => [
            ['feature_key' => 'is_reusable', 'feature_value' => 'true', 'description' => 'Complete beginner-friendly setup'],
            ['feature_key' => 'has_colors', 'feature_value' => 'true', 'description' => 'Comes in various colors'],
            ['feature_key' => 'has_flavors', 'feature_value' => 'false', 'description' => 'May include sample e-liquids but flavors not device-specific'],
            ['feature_key' => 'is_beginner_friendly', 'feature_value' => 'true', 'description' => 'Designed for new vapers'],
            ['feature_key' => 'includes_tank', 'feature_value' => 'true', 'description' => 'Comes with complete tank setup'],
            ['feature_key' => 'includes_batteries', 'feature_value' => 'sometimes', 'description' => 'May or may not include batteries'],
            ['feature_key' => 'has_instructions', 'feature_value' => 'true', 'description' => 'Includes beginner instructions'],
            ['feature_key' => 'safety_features', 'feature_value' => 'comprehensive', 'description' => 'Built-in protections for new users'],
            ['feature_key' => 'ease_of_use', 'feature_value' => 'high', 'description' => 'Simple operation and maintenance'],
            ['feature_key' => 'learning_curve', 'feature_value' => 'low', 'description' => 'Easy to learn and use'],
        ]
    ],
    [
        'category_name' => 'Pod Mod',
        'slug' => 'pod-mod',
        'description' => 'Hybrid devices that combine the convenience of pod systems with the power and features of box mods. Pod mods offer adjustable settings, better battery life, and enhanced performance while maintaining the portability and simplicity of pod-based devices. Perfect for vapers who want more control without the bulk of traditional mods.',
        'features' => [
            ['feature_key' => 'is_reusable', 'feature_value' => 'true', 'description' => 'Advanced pod systems with mod features'],
            ['feature_key' => 'has_colors', 'feature_value' => 'true', 'description' => 'Comes in various colors'],
            ['feature_key' => 'has_flavors', 'feature_value' => 'false', 'description' => 'Refillable pods, flavors separate'],
            ['feature_key' => 'has_adjustable_wattage', 'feature_value' => 'true', 'description' => 'Variable wattage settings'],
            ['feature_key' => 'has_screen', 'feature_value' => 'true', 'description' => 'Typically includes display screen'],
            ['feature_key' => 'is_versatile', 'feature_value' => 'true', 'description' => 'Suitable for both MTL and DTL vaping'],
            ['feature_key' => 'has_airflow_control', 'feature_value' => 'true', 'description' => 'Adjustable airflow settings'],
            ['feature_key' => 'battery_capacity', 'feature_value' => 'large', 'description' => 'Larger batteries than standard pods'],
            ['feature_key' => 'power_output', 'feature_value' => 'medium', 'description' => 'Balanced power for various vaping styles'],
            ['feature_key' => 'portability', 'feature_value' => 'medium', 'description' => 'More portable than box mods, less than pods'],
        ]
    ],
    [
        'category_name' => 'Tanks & Atomizers',
        'hardware'=>false , 
        'slug' => 'tanks',
        'description' => 'Replacement tanks and rebuildable atomizers for advanced vaping setups. These components hold e-liquid and house the coil, determining flavor quality and vapor production. Includes sub-ohm tanks for massive clouds and rebuildable atomizers for custom coil building.',
        'features' => [
            ['feature_key' => 'is_reusable', 'feature_value' => 'true', 'description' => 'Refillable and reusable components'],
            ['feature_key' => 'requires_device', 'feature_value' => 'true', 'description' => 'Needs a separate mod/battery'],
            ['feature_key' => 'coil_compatibility', 'feature_value' => 'specific', 'description' => 'Designed for specific coil types'],
            ['feature_key' => 'e-liquid_capacity', 'feature_value' => 'variable', 'description' => 'Various tank sizes available'],
            ['feature_key' => 'build_type', 'feature_value' => 'prebuilt', 'description' => 'Uses factory-made coils'],
        ]
    ],
    [
        'category_name' => 'Coils & Pods',
        'hardware'=>false , 
        'slug' => 'coils-pods',
        'description' => 'Replacement coils and pods for maintaining your vaping devices. Coils are the heating elements that need regular replacement, while pods are the refillable containers for pod systems. Essential accessories for keeping your device performing optimally.',
        'features' => [
            ['feature_key' => 'is_consumable', 'feature_value' => 'true', 'description' => 'Regular replacement required'],
            ['feature_key' => 'device_specific', 'feature_value' => 'true', 'description' => 'Designed for particular devices'],
            ['feature_key' => 'resistance_options', 'feature_value' => 'varied', 'description' => 'Different ohms for various styles'],
            ['feature_key' => 'lifespan', 'feature_value' => 'limited', 'description' => 'Wear out with use'],
        ]
    ],
    [
        'category_name' => 'Accessories',
        'hardware'=>false , 
        'slug' => 'accessories',
        'description' => 'Essential vaping accessories and maintenance products. Includes batteries, chargers, cases, building tools, and cleaning supplies. These items help enhance your vaping experience, improve safety, and maintain your equipment.',
        'features' => [
            ['feature_key' => 'is_essential', 'feature_value' => 'sometimes', 'description' => 'Some accessories are required'],
            ['feature_key' => 'improves_safety', 'feature_value' => 'true', 'description' => 'Enhances device safety'],
            ['feature_key' => 'extends_lifespan', 'feature_value' => 'true', 'description' => 'Helps maintain equipment'],
            ['feature_key' => 'variety', 'feature_value' => 'wide', 'description' => 'Many different types available'],
        ]
    ], 
    [
        'category_name' => 'Cartridges',
        'hardware'=>false , 
        'slug' => 'cartridges',
        'description' => 'Pre-filled or refillable cartridges containing e-liquid and coil, designed for specific vaping devices. Cartridges offer convenience and ease of use, providing a complete vaping solution without the need for separate e-liquid bottles. Available in various nicotine strengths and flavors.',
        'features' => [
            ['feature_key' => 'is_consumable', 'feature_value' => 'true', 'description' => 'Designed for single or limited use'],
            ['feature_key' => 'device_specific', 'feature_value' => 'true', 'description' => 'Compatible with specific devices'],
            ['feature_key' => 'has_flavors', 'feature_value' => 'true', 'description' => 'Pre-filled with specific e-liquid flavors'],
            ['feature_key' => 'nicotine_strengths', 'feature_value' => 'varied', 'description' => 'Available in different nicotine levels'],
            ['feature_key' => 'is_prefilled', 'feature_value' => 'sometimes', 'description' => 'May be pre-filled or refillable'],
            ['feature_key' => 'integrated_coil', 'feature_value' => 'true', 'description' => 'Contains built-in heating element'],
            ['feature_key' => 'puff_count', 'feature_value' => 'estimated', 'description' => 'Approximate number of puffs per cartridge'],
            ['feature_key' => 'e-liquid_capacity', 'feature_value' => 'standardized', 'description' => 'Fixed capacity based on device compatibility'],
        ]
            ],
];

        foreach ($categoriesWithFeatures as $categoryData) {
            $category = DevicesCategories::firstOrCreate(['name'=>$categoryData['category_name'] , 'hardware'=>$categoryData['hardware']??true]);
            $category->update(['slug'=>$categoryData['slug'], 'description'=>$categoryData['description'] ,  'hardware'=>$categoryData['hardware']??true]);
            foreach($categoryData['features'] as $featureData){
                $category->features()->create($featureData);
            }
           
        }
    }
}
