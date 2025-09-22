<?php

namespace Database\Seeders;


use App\Models\Cartidges\Cartidge;
use App\Models\Cartidges\CartidgeVariants;
use App\Models\Hardware\DeviceBrands;
use App\Models\Hardware\DevicesCategories;
use Illuminate\Database\Seeder;

class CartridgesSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $brands = [
            'Vaporesso' => [
                'country' => 'China',
                'website' => 'https://www.vaporesso.com',
                'description' => 'Innovative vaping technology and high-quality devices',
                'cartridges' => [
                    [
                        'name' => 'Vaporesso XROS Pod Cartridge',
                        'type' => 'refillable',
                        'capacity_ml' => 2.0,
                        'description' => 'Refillable pod cartridge for XROS series',
                        'material' => 'PCTG',
                        'coil_type' => 'mesh',
                        'variants' => [
                            ['resistance' => '0.8', 'vaping_style' => 'MTL'],
                            ['resistance' => '1.2', 'vaping_style' => 'MTL'],
                        ]
                    ],
                    [
                        'name' => 'Vaporesso GTX Pod Cartridge',
                        'type' => 'refillable',
                        'capacity_ml' => 3.0,
                        'description' => 'Refillable pod cartridge for GTX devices',
                        'material' => 'PCTG',
                        'coil_type' => 'mesh',
                        'variants' => [
                            ['resistance' => '0.6', 'vaping_style' => 'RDL'],
                            ['resistance' => '0.8', 'vaping_style' => 'MTL'],
                            ['resistance' => '1.2', 'vaping_style' => 'MTL'],
                        ]
                    ],
                    [
                        'name' => 'Vaporesso Luxe X Prefilled Pod',
                        'type' => 'prefilled',
                        'capacity_ml' => 5.0,
                        'description' => 'Prefilled pod with various flavor options',
                        'material' => 'PCTG',
                        'coil_type' => 'mesh',
                        'variants' => [
                            ['resistance' => '0.8', 'vaping_style' => 'MTL'],
                            ['resistance' => '1.0', 'vaping_style' => 'MTL'],
                        ]
                    ]
                ]
            ],
            'SMOK' => [
                'country' => 'China',
                'website' => 'https://www.smok.com',
                'description' => 'Popular brand with extensive device options',
                'cartridges' => [
                    [
                        'name' => 'SMOK Nord Cartridge',
                        'type' => 'refillable',
                        'capacity_ml' => 3.0,
                        'description' => 'Refillable cartridge for Nord series',
                        'material' => 'PCTG',
                        'coil_type' => 'mesh',
                        'variants' => [
                            ['resistance' => '0.6', 'vaping_style' => 'RDL'],
                            ['resistance' => '0.8', 'vaping_style' => 'MTL'],
                            ['resistance' => '1.4', 'vaping_style' => 'MTL'],
                        ]
                    ],
                    [
                        'name' => 'SMOK Nord 2 Empty Pod',
                        'type' => 'refillable',
                        'capacity_ml' => 4.5,
                        'description' => 'Empty pod without coil; compatible with Nord coils',
                        'material' => 'PCTG',
                        
                        
                    ],
                    [
                        'name' => 'SMOK RPM Empty Pod',
                        'type' => 'refillable',
                        'capacity_ml' => 4.5,
                        'description' => 'Empty cartridge, resistance depends on installed RPM coil',
                        'material' => 'PCTG',
                        
                        
                    ],
                    [
                        'name' => 'SMOK Novo Disposable Pod',
                        'type' => 'disposable',
                        'capacity_ml' => 2.0,
                        'description' => 'Disposable pod for Novo devices',
                        'material' => 'PCTG',
                        'coil_type' => 'cotton',
                        'variants' => [
                            ['resistance' => '1.0', 'vaping_style' => 'MTL'],
                        ]
                    ],
                    [
                        'name' => 'SMOK RPM Prefilled Pod',
                        'type' => 'prefilled',
                        'capacity_ml' => 4.5,
                        'description' => 'Prefilled pod for RPM devices',
                        'material' => 'PCTG',
                        'coil_type' => 'mesh',
                        'variants' => [
                            ['resistance' => '0.4', 'vaping_style' => 'DL'],
                            ['resistance' => '0.6', 'vaping_style' => 'RDL'],
                        ]
                    ]
                ]
            ],
            'Uwell' => [
                'country' => 'China',
                'website' => 'https://www.uwell.com',
                'description' => 'Known for exceptional flavor production',
                'cartridges' => [
                    [
                        'name' => 'Uwell Caliburn G Pod',
                        'type' => 'refillable',
                        'capacity_ml' => 2.0,
                        'description' => 'Refillable pod for Caliburn G series',
                        'material' => 'PCTG',
                        'coil_type' => 'mesh',
                        'variants' => [
                            ['resistance' => '0.8', 'vaping_style' => 'MTL'],
                            ['resistance' => '1.0', 'vaping_style' => 'MTL'],
                        ]
                    ],
                    [
                        'name' => 'Uwell Yearn Neat 2 Disposable Pod',
                        'type' => 'disposable',
                        'capacity_ml' => 2.0,
                        'description' => 'Disposable pod for Yearn Neat 2',
                        'material' => 'PCTG',
                        'coil_type' => 'cotton',
                        'variants' => [
                            ['resistance' => '1.2', 'vaping_style' => 'MTL'],
                        ]
                    ],
                    [
                        'name' => 'Uwell Valyrian Pod Tank',
                        'type' => 'refillable',
                        'capacity_ml' => 5.0,
                        'description' => 'Large capacity pod tank for Valyrian series',
                        'material' => 'Glass',
                        'coil_type' => 'mesh',
                        'variants' => [
                            ['resistance' => '0.3', 'vaping_style' => 'DL'],
                            ['resistance' => '0.6', 'vaping_style' => 'RDL'],
                        ]
                    ]
                ]
            ],
            'VooPoo' => [
                'country' => 'China',
                'website' => 'https://www.voopoo.com',
                'description' => 'Famous for the GENE chip and popular pod systems',
                'cartridges' => [
                    [
                        'name' => 'VooPoo Drag X Pod Tank',
                        'type' => 'refillable',
                        'capacity_ml' => 4.5,
                        'description' => 'Refillable pod tank for Drag X/S',
                        'material' => 'PCTG',
                        'coil_type' => 'mesh',
                        'variants' => [
                            ['resistance' => '0.3', 'vaping_style' => 'DL'],
                            ['resistance' => '0.45', 'vaping_style' => 'RDL'],
                        ]
                    ],
                    [
                        'name' => 'VooPoo PnP Empty Pod',
                        'type' => 'refillable',
                        'capacity_ml' => 4.5,
                        'description' => 'Empty pod tank, compatible with PnP coil series, no fixed resistance',
                        'material' => 'PCTG',
                        
                        
                    ],
                    [
                        'name' => 'VooPoo Drag S Empty Pod',
                        'type' => 'refillable',
                        'capacity_ml' => 4.5,
                        'description' => 'Empty replacement pod for Drag S, coils sold separately',
                        'material' => 'PCTG',
                        
                        
                    ],
                    [
                        'name' => 'VooPoo Vinci Prefilled Pod',
                        'type' => 'prefilled',
                        'capacity_ml' => 3.0,
                        'description' => 'Prefilled pod for Vinci devices',
                        'material' => 'PCTG',
                        'coil_type' => 'mesh',
                        'variants' => [
                            ['resistance' => '0.8', 'vaping_style' => 'MTL'],
                            ['resistance' => '1.2', 'vaping_style' => 'MTL'],
                        ]
                    ],
                    [
                        'name' => 'VooPoo Argus Pod Cartridge',
                        'type' => 'refillable',
                        'capacity_ml' => 2.0,
                        'description' => 'Refillable cartridge for Argus Pod',
                        'material' => 'PCTG',
                        'coil_type' => 'mesh',
                        'variants' => [
                            ['resistance' => '0.7', 'vaping_style' => 'RDL'],
                            ['resistance' => '1.2', 'vaping_style' => 'MTL'],
                        ]
                    ]
                ]
            ],
            'GeekVape' => [
                'country' => 'China',
                'website' => 'https://www.geekvape.com',
                'description' => 'Durable and waterproof vaping devices',
                'cartridges' => [
                    [
                        'name' => 'GeekVape Aegis Pod Cartridge',
                        'type' => 'refillable',
                        'capacity_ml' => 3.0,
                        'description' => 'Refillable cartridge for Aegis Pod',
                        'material' => 'PCTG',
                        'coil_type' => 'mesh',
                        'variants' => [
                            ['resistance' => '0.6', 'vaping_style' => 'RDL'],
                            ['resistance' => '1.2', 'vaping_style' => 'MTL'],
                        ]
                    ],
                    [
                        'name' => 'GeekVape Wenax Pod',
                        'type' => 'refillable',
                        'capacity_ml' => 2.0,
                        'description' => 'Refillable pod for Wenax series',
                        'material' => 'PCTG',
                        'coil_type' => 'mesh',
                        'variants' => [
                            ['resistance' => '0.6', 'vaping_style' => 'RDL'],
                            ['resistance' => '1.2', 'vaping_style' => 'MTL'],
                        ]
                    ],
                    [
                        'name' => 'GeekVape Boost Pro Pod Tank',
                        'type' => 'refillable',
                        'capacity_ml' => 5.0,
                        'description' => 'Large capacity pod tank for Boost Pro',
                        'material' => 'PCTG',
                        'coil_type' => 'mesh',
                        'variants' => [
                            ['resistance' => '0.2', 'vaping_style' => 'DL'],
                            ['resistance' => '0.4', 'vaping_style' => 'RDL'],
                        ]
                    ],
                    [
                        'name' => 'GeekVape Aegis Boost Empty Pod',
                        'type' => 'refillable',
                        'capacity_ml' => 3.7,
                        'description' => 'Empty pod without coil, supports Boost coils of different resistances',
                        'material' => 'PCTG',
                        
                        
                    ]
                ]
            ],
            'MYLÉ' => [
                'country' => 'USA',
                'website' => 'https://myle.com',
                'description' => 'Nicotine salt pod system brand',
                'cartridges' => [
                    [
                        'name' => 'MYLÉ Prefilled Pod',
                        'type' => 'prefilled',
                        'capacity_ml' => 0.9,
                        'description' => 'Prefilled pod with flavored nicotine salt e-liquid, resistance not specified',
                        'material' => 'PCTG',
                        'coil_type' => 'ceramic',
                        
                    ],
                ],
            ],
            'JUUL' => [
                'country' => 'USA',
                'website' => 'https://www.juul.com',
                'description' => 'Well-known closed pod system',
                'cartridges' => [
                    [
                        'name' => 'JUUL Prefilled Pod',
                        'type' => 'prefilled',
                        'capacity_ml' => 0.7,
                        'description' => 'Prefilled pod available in multiple flavors, manufacturer does not publish coil resistance',
                        'material' => 'PCTG',
                        'coil_type' => 'ceramic',
                        
                    ],
                ],
            ],
            'Aspire' => [
        'country' => 'China',
        'website' => 'https://www.aspirecig.com',
        'description' => 'Innovative vaping products with focus on flavor and performance',
        'cartridges' => [
            [
                'name' => 'Aspire Nautilus Prime X Pod',
                'type' => 'refillable',
                'capacity_ml' => 4.0,
                'description' => 'Refillable pod for Nautilus Prime X with BVC coil compatibility',
                'material' => 'PCTG',
                'coil_type' => 'mesh',
                'variants' => [
                    ['resistance' => '0.7', 'vaping_style' => 'RDL'],
                    ['resistance' => '1.0', 'vaping_style' => 'MTL'],
                ]
            ], [
                'name' => 'Aspire Nautilus Prime X Pod',
                'type' => 'refillable',
                'capacity_ml' => 4.0,
                'description' => 'Refillable pod with BVC coil compatibility',
                'material' => 'PCTG',
                'coil_type' => 'mesh',
                'variants' => [
                    ['resistance' => '0.7', 'vaping_style' => 'RDL'],
                    ['resistance' => '1.0', 'vaping_style' => 'MTL'],
                ]
            ],
            [
                'name' => 'Aspire Favostix Empty Pod',
                'type' => 'refillable',
                'capacity_ml' => 2.0,
                'description' => 'Compact refillable pod for Favostix series',
                'material' => 'PCTG',
                'coil_type' => 'mesh',
                'variants' => [
                    ['resistance' => '0.6', 'vaping_style' => 'RDL'],
                    ['resistance' => '1.0', 'vaping_style' => 'MTL'],
                ]
                ],
            [
                'name' => 'Aspire Favostix Empty Pod',
                'type' => 'refillable',
                'capacity_ml' => 2.0,
                'description' => 'Empty refillable pod for Favostix series',
                'material' => 'PCTG',
                'coil_type' => 'mesh',
                'variants' => [
                    ['resistance' => '0.6', 'vaping_style' => 'RDL'],
                    ['resistance' => '1.0', 'vaping_style' => 'MTL'],
                ]
            ],
            [
                'name' => 'Aspire Prefilled Pod',
                'type' => 'prefilled',
                'capacity_ml' => 2.5,
                'description' => 'Prefilled pod with various flavor options',
                'material' => 'PCTG',
                'coil_type' => 'ceramic',
                'variants' => [
                    ['resistance' => '1.2', 'vaping_style' => 'MTL'],
                ]
            ]
        ]
            ],
            'Innokin' => [
                'country' => 'China',
                'website' => 'https://www.innokin.com',
                'description' => 'Quality vaping devices with focus on safety and reliability',
                'cartridges' => [
                    [
                        'name' => 'Innokin Sensis Pod',
                        'type' => 'refillable',
                        'capacity_ml' => 3.0,
                        'description' => 'Refillable pod for Sensis with innovative coil technology',
                        'material' => 'PCTG',
                        'coil_type' => 'mesh',
                        'variants' => [
                            ['resistance' => '0.25', 'vaping_style' => 'DL'],
                            ['resistance' => '0.65', 'vaping_style' => 'RDL'],
                        ]
                    ],
                    [
                        'name' => 'Innokin EQ Pod Cartridge',
                        'type' => 'refillable',
                        'capacity_ml' => 2.0,
                        'description' => 'Refillable cartridge for EQ series',
                        'material' => 'PCTG',
                        'coil_type' => 'mesh',
                        'variants' => [
                            ['resistance' => '0.5', 'vaping_style' => 'RDL'],
                            ['resistance' => '1.2', 'vaping_style' => 'MTL'],
                        ]
                        ],
                         [
                'name' => 'Innokin Zlide Pod Tank',
                'type' => 'refillable',
                'capacity_ml' => 4.0,
                'description' => 'Top-fill pod tank with Z-coil compatibility',
                'material' => 'PCTG',
                'coil_type' => 'mesh',
                'variants' => [
                    ['resistance' => '0.3', 'vaping_style' => 'DL'],
                    ['resistance' => '0.8', 'vaping_style' => 'MTL'],
                ]
            ]
                ]
            ],
            'Lost Vape' => [
    'country' => 'China',
    'website' => 'https://www.lostvape.com',
    'description' => 'Premium vaping devices with DNA chip technology',
    'cartridges' => [
        [
            'name' => 'Lost Vape Orion Plus Pod',
            'type' => 'refillable',
            'capacity_ml' => 2.5,
            'description' => 'Refillable pod for Orion Plus series',
            'material' => 'PCTG',
            'coil_type' => 'mesh',
            'variants' => [
                ['resistance' => '0.25', 'vaping_style' => 'DL'],
                ['resistance' => '0.5', 'vaping_style' => 'RDL'],
            ]
        ],
        [
            'name' => 'Lost Vape Ursa Mini Pod',
            'type' => 'refillable',
            'capacity_ml' => 4.5,
            'description' => 'Refillable pod for Ursa Mini with adjustable airflow',
            'material' => 'PCTG',
            'coil_type' => 'mesh',
            'variants' => [
                ['resistance' => '0.3', 'vaping_style' => 'DL'],
                ['resistance' => '0.6', 'vaping_style' => 'RDL'],
            ]
        ]
    ]
            ], 
            'Vape Egypt' => [
                'country' => 'Egypt',
                'website' => 'https://www.vapeegypt.com',
                'description' => 'Leading Egyptian vape brand offering affordable and reliable products',
                'cartridges' => [
                    [
                        'name' => 'Vape Egypt Nile Pod',
                        'type' => 'refillable',
                        'capacity_ml' => 2.5,
                        'description' => 'Popular refillable pod designed for Egyptian market conditions',
                        'material' => 'PCTG',
                        'coil_type' => 'mesh',
                        'variants' => [
                            ['resistance' => '0.8', 'vaping_style' => 'MTL'],
                            ['resistance' => '1.2', 'vaping_style' => 'MTL'],
                        ]
                    ],
                    [
                        'name' => 'Vape Egypt Cairo Disposable Pod',
                        'type' => 'disposable',
                        'capacity_ml' => 2.0,
                        'description' => 'Convenient disposable pod with popular local flavors',
                        'material' => 'PCTG',
                        'coil_type' => 'cotton',
                        'variants' => [
                            ['resistance' => '1.0', 'vaping_style' => 'MTL'],
                        ]
                    ]
                ]
            ],
            'Pharaoh Vape' => [
                'country' => 'Egypt',
                'website' => 'https://www.pharaohvape.com',
                'description' => 'Premium Egyptian vape brand with ancient Egyptian themed products',
                'cartridges' => [
                    [
                        'name' => 'Pharaoh Pyramid Pod',
                        'type' => 'refillable',
                        'capacity_ml' => 3.0,
                        'description' => 'Premium refillable pod with pyramid-inspired design',
                        'material' => 'PCTG',
                        'coil_type' => 'mesh',
                        'variants' => [
                            ['resistance' => '0.6', 'vaping_style' => 'RDL'],
                            ['resistance' => '1.0', 'vaping_style' => 'MTL'],
                        ]
                    ],
                    [
                        'name' => 'Pharaoh Prefilled Pod - Egyptian Flavors',
                        'type' => 'prefilled',
                        'capacity_ml' => 2.0,
                        'description' => 'Prefilled pods with unique Egyptian-inspired flavors',
                        'material' => 'PCTG',
                        'coil_type' => 'ceramic',
                        'variants' => [
                            ['resistance' => '1.2', 'vaping_style' => 'MTL'],
                        ]
                    ]
                ]
            ],
            'Cairo Cloud' => [
                'country' => 'Egypt',
                'website' => 'https://www.cairocloud.com',
                'description' => 'Local Egyptian brand focused on beginner-friendly devices',
                'cartridges' => [
                    [
                        'name' => 'Cairo Cloud Mini Pod',
                        'type' => 'refillable',
                        'capacity_ml' => 2.0,
                        'description' => 'Compact refillable pod perfect for beginners',
                        'material' => 'PCTG',
                        'coil_type' => 'mesh',
                        'variants' => [
                            ['resistance' => '1.2', 'vaping_style' => 'MTL'],
                        ]
                    ],
                    [
                        'name' => 'Cairo Cloud Disposable',
                        'type' => 'disposable',
                        'capacity_ml' => 1.8,
                        'description' => 'Affordable disposable pod with Egyptian tobacco flavors',
                        'material' => 'PCTG',
                        'coil_type' => 'cotton',
                        'variants' => [
                            ['resistance' => '1.0', 'vaping_style' => 'MTL'],
                        ]
                    ]
                ]
            ],
            'Nile Vape' => [
                'country' => 'Egypt',
                'website' => 'https://www.nilevape.com',
                'description' => 'Egyptian brand offering high-quality locally manufactured products',
                'cartridges' => [
                    [
                        'name' => 'Nile Vape Delta Pod',
                        'type' => 'refillable',
                        'capacity_ml' => 3.5,
                        'description' => 'Durable refillable pod designed for Egyptian climate',
                        'material' => 'PCTG',
                        'coil_type' => 'mesh',
                        'variants' => [
                            ['resistance' => '0.7', 'vaping_style' => 'RDL'],
                            ['resistance' => '1.2', 'vaping_style' => 'MTL'],
                        ]
                    ],
                    [
                        'name' => 'Nile Vape Prefilled - Local Flavors',
                        'type' => 'prefilled',
                        'capacity_ml' => 2.2,
                        'description' => 'Prefilled pods featuring popular Egyptian flavor profiles',
                        'material' => 'PCTG',
                        'coil_type' => 'ceramic',
                        'variants' => [
                            ['resistance' => '1.0', 'vaping_style' => 'MTL'],
                        ]
                    ]
                ]
                        ],
                        

    // Innovative Technology Brands
    'Voopoo' => [
        'country' => 'China',
        'website' => 'https://www.voopoo.com',
        'description' => 'Known for GENE chip technology and high-performance devices',
        'cartridges' => [
            [
                'name' => 'Voopoo PnP Pod Tank',
                'type' => 'refillable',
                'capacity_ml' => 4.5,
                'description' => 'Universal pod tank compatible with PnP coil series',
                'material' => 'PCTG',
                'coil_type' => 'mesh',
                'variants' => [
                    ['resistance' => '0.15', 'vaping_style' => 'DL'],
                    ['resistance' => '0.3', 'vaping_style' => 'DL'],
                    ['resistance' => '0.6', 'vaping_style' => 'RDL'],
                ]
            ]
        ]
    ],

    // Disposable Specialists
    'Elf Bar' => [
        'country' => 'China',
        'website' => 'https://www.elfbar.com',
        'description' => 'World leader in disposable vape devices',
        'cartridges' => [
            [
                'name' => 'Elf Bar Prefilled Disposable',
                'type' => 'disposable',
                'capacity_ml' => 2.0,
                'description' => 'All-in-one disposable device with integrated battery',
                'material' => 'PCTG',
                'coil_type' => 'mesh',
                'variants' => [
                    ['resistance' => '1.2', 'vaping_style' => 'MTL'],
                ]
            ]
        ]
    ],

    // High-End American Brands
    'Suorin' => [
        'country' => 'USA',
        'website' => 'https://www.suorin.com',
        'description' => 'Sleek and compact pod systems',
        'cartridges' => [
            [
                'name' => 'Suorin Air Plus Pod',
                'type' => 'refillable',
                'capacity_ml' => 3.0,
                'description' => 'Ultra-slim refillable pod cartridge',
                'material' => 'PCTG',
                'coil_type' => 'mesh',
                'variants' => [
                    ['resistance' => '0.7', 'vaping_style' => 'RDL'],
                    ['resistance' => '1.0', 'vaping_style' => 'MTL'],
                ]
            ]
        ]
    ],


    // New Emerging Brands
    'Oxva' => [
        'country' => 'China',
        'website' => 'https://www.oxva.com',
        'description' => 'Innovative pod systems with unique features',
        'cartridges' => [
            [
                'name' => 'Oxva Xlim Pod',
                'type' => 'refillable',
                'capacity_ml' => 3.0,
                'description' => 'Refillable pod with adjustable airflow',
                'material' => 'PCTG',
                'coil_type' => 'mesh',
                'variants' => [
                    ['resistance' => '0.6', 'vaping_style' => 'RDL'],
                    ['resistance' => '0.8', 'vaping_style' => 'MTL'],
                    ['resistance' => '1.2', 'vaping_style' => 'MTL'],
                ]
            ]
        ]
    ],

    // Luxury Brand
    'Dovpo' => [
        'country' => 'China',
        'website' => 'https://www.dovpo.com',
        'description' => 'Premium devices with exceptional build quality',
        'cartridges' => [
            [
                'name' => 'Dovpo Abyss Pod Tank',
                'type' => 'refillable',
                'capacity_ml' => 5.5,
                'description' => 'Large capacity pod tank with multiple coil compatibility',
                'material' => 'Pyrex Glass',
                'coil_type' => 'mesh',
                'variants' => [
                    ['resistance' => '0.2', 'vaping_style' => 'DL'],
                    ['resistance' => '0.3', 'vaping_style' => 'DL'],
                ]
            ]
        ]
    ]
];

// Specialized Cartridge Types
$specialtyCartridges = [
    'Caliburn' => [
        'country' => 'China',
        'website' => 'https://www.uclvape.com',
        'description' => 'Popular pod systems known for flavor production',
        'cartridges' => [
            [
                'name' => 'Caliburn G2 Pod',
                'type' => 'refillable',
                'capacity_ml' => 2.0,
                'description' => 'Refillable pod with pro-focs flavor technology',
                'material' => 'PCTG',
                'coil_type' => 'mesh',
                'variants' => [
                    ['resistance' => '0.8', 'vaping_style' => 'MTL'],
                    ['resistance' => '1.2', 'vaping_style' => 'MTL'],
                ]
            ]
        ]
    ],

    // CBD/THC Specialized
    'Pax' => [
        'country' => 'USA',
        'website' => 'https://www.pax.com',
        'description' => 'Premium vaporizers for dry herb and concentrates',
        'cartridges' => [
            [
                'name' => 'Pax Era Pod',
                'type' => 'prefilled',
                'capacity_ml' => 0.5,
                'description' => 'Premium cannabis oil pod with temperature control',
                'material' => 'Ceramic',
                'coil_type' => 'ceramic',
                'variants' => [
                    ['resistance' => '1.5', 'vaping_style' => 'MTL'],
                ]
            ]
        ]
    ]
        ];

        $categoryId = DevicesCategories::where('name','Cartridges')->value('id');

        foreach ($brands as $brandName => $brandDetails) {
            // Find or create the brand
            $brand = DeviceBrands::firstOrCreate([
                'name' => $brandName,
                'country' => $brandDetails['country'],
                'website' => $brandDetails['website'],
            ]);

            // Create cartridges for this brand
            foreach ($brandDetails['cartridges'] as $cartridgeData) {
                $cartridge = Cartidge::create([
                    'name' => $cartridgeData['name'],
                    'type' => $cartridgeData['type'],
                    'capacity_ml' => $cartridgeData['capacity_ml'],
                    'description' => $cartridgeData['description'],
                    'material' => $cartridgeData['material'],
                    'coil_type' => $cartridgeData['coil_type'] ?? null ,
                    'brand_id' => $brand->id,
                    'category_id' => $categoryId
                ]);

                // Create variants for this cartridge
                $variantsCartridges = $cartridgeData['variants'] ?? null ; 
                if($variantsCartridges){
                    foreach ($variantsCartridges as $variantData) {
                        CartidgeVariants::create([
                            'cartridge_id' => $cartridge->id,
                            'resistance' => $variantData['resistance'],
                            'vaping_style'=> $variantData['vaping_style'],
                        ]);
                    }
                }
                else{
                    CartidgeVariants::create([
                        'cartridge_id' => $cartridge->id,
                        'resistance' => 0.00
                    ]);
                    $cartridge->update(['has_resistance'=>false]);
                }
            }
        }
    }
}