<?php

namespace Database\Seeders;

use App\Models\CommonModels\Brand;
use App\Models\CommonModels\Category;
use App\Models\CommonModels\Component;
use App\Models\Vape\Flavour;
use App\Models\Vape\FlavourComponent;
use App\Models\Vape\Liquid;
use App\Models\Vape\LiquidNicStrength;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    
    public function run(): void
    {
        DB::table('brand')->delete();
        $brands = [
            'Nasty Juice' => [
                'country' => 'Malaysia',
                'flavors' => [
                    [
                        'name' => 'A$AP Grape',
                        'category' => 'Fruits',
                        'components' => ['Grape', 'Berry'],
                        'liquids' => [
                            [
                                'liquid_id' => 1001,
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'flavour_id' => null,
                                'nicotine_strengths' => [20, 35, 50]
                            ],
                            [
                                'liquid_id' => 1002,
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 60,
                                'flavour_id' => null,
                                'nicotine_strengths' => [0, 3, 6]
                            ]
                        ],
                    ],
                    [
                        'name' => 'Wicked Haze',
                        'category' => 'Fruits',
                        'components' => ['Blackcurrant', 'Lemonade'],
                        'liquids' => [
                            [
                                'liquid_id' => 1003,
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'flavour_id' => null,
                                'nicotine_strengths' => [20, 35, 50]
                            ],
                            [
                                'liquid_id' => 1004,
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 60,
                                'flavour_id' => null,
                                'nicotine_strengths' => [0, 3, 6]
                            ]
                        ],
                    ],
                    [
                        'name' => 'Bad Blood',
                        'category' => 'Fruits',
                        'components' => ['Blackcurrant'],
                        'liquids' => [
                            [
                                'liquid_id' => 1005,
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'flavour_id' => null,
                                'nicotine_strengths' => [20, 35, 50]
                            ],
                            [
                                'liquid_id' => 1006,
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 60,
                                'flavour_id' => null,
                                'nicotine_strengths' => [0, 3, 6]
                            ]
                        ],
                    ],
                    [
                        'name' => 'Slow Blow',
                        'category' => 'Drinks & Beverages',
                        'components' => ['Pineapple', 'Soda'],
                        'liquids' => [
                            [
                                'liquid_id' => 1007,
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'flavour_id' => null,
                                'nicotine_strengths' => [20, 35, 50]
                            ],
                            [
                                'liquid_id' => 1008,
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 60,
                                'flavour_id' => null,
                                'nicotine_strengths' => [0, 3, 6]
                            ]
                        ],
                    ],
                    [
                        'name' => 'Cush Man',
                        'category' => 'Fruits',
                        'components' => ['Mango'],
                        'liquids' => [
                            [
                                'liquid_id' => 1009,
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'flavour_id' => null,
                                'nicotine_strengths' => [20, 35, 50]
                            ],
                            [
                                'liquid_id' => 1010,
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 60,
                                'flavour_id' => null,
                                'nicotine_strengths' => [0, 3, 6]
                            ]
                        ],
                    ],
                ],
            ],
            'Dinner Lady' => [
                'country' => 'United Kingdom',
                'flavors' => [
                    [
                        'name' => 'Lemon Tart',
                        'category' => 'Desserts',
                        'components' => ['Lemon', 'Pastry', 'Custard'],
                        'liquids' => [
                            [
                                'liquid_id' => 1011,
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'flavour_id' => null,
                                'nicotine_strengths' => [20, 35, 50]
                            ],
                            [
                                'liquid_id' => 1012,
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 60,
                                'flavour_id' => null,
                                'nicotine_strengths' => [0, 3, 6]
                            ]
                        ],
                    ],
                    [
                        'name' => 'Berry Blast',
                        'category' => 'Fruits',
                        'components' => ['Raspberry', 'Blueberry', 'Blackberry'],
                        'liquids' => [
                            [
                                'liquid_id' => 1013,
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'flavour_id' => null,
                                'nicotine_strengths' => [20, 35, 50]
                            ],
                            [
                                'liquid_id' => 1014,
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 60,
                                'flavour_id' => null,
                                'nicotine_strengths' => [0, 3, 6]
                            ]
                        ],
                    ],
                    [
                        'name' => 'Apple Pie',
                        'category' => 'Bakery',
                        'components' => ['Apple', 'Cinnamon', 'Pie Crust'],
                        'liquids' => [
                            [
                                'liquid_id' => 1015,
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'flavour_id' => null,
                                'nicotine_strengths' => [20, 35, 50]
                            ],
                            [
                                'liquid_id' => 1016,
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 60,
                                'flavour_id' => null,
                                'nicotine_strengths' => [0, 3, 6]
                            ]
                        ],
                    ],
                    [
                        'name' => 'Mango Tart',
                        'category' => 'Desserts',
                        'components' => ['Mango', 'Pastry'],
                        'liquids' => [
                            [
                                'liquid_id' => 1017,
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'flavour_id' => null,
                                'nicotine_strengths' => [20, 35, 50]
                            ],
                            [
                                'liquid_id' => 1018,
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 60,
                                'flavour_id' => null,
                                'nicotine_strengths' => [0, 3, 6]
                            ]
                        ],
                    ],
                ],
            ],

            'Pachamama' => [
                'country' => 'United States',
                'flavors' => [
                    [
                        'name' => 'Fuji Apple Strawberry Nectarine',
                        'category' => 'Fruits',
                        'components' => ['Fuji Apple', 'Strawberry', 'Nectarine'],
                        'liquids' => [
                            [
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'nicotine_strengths' => [20, 35, 50],
                                'flavour_id' => null,
                            ],
                            [
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 60,
                                'nicotine_strengths' => [0, 3, 6],
                                'flavour_id' => null,
                            ]
                        ]
                    ],
                    [
                        'name' => 'Peach Papaya Coconut Cream',
                        'category' => 'Fruits',
                        'components' => ['Peach', 'Papaya', 'Coconut Cream'],
                        'liquids' => [
                            [
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'nicotine_strengths' => [20, 35, 50],
                                'flavour_id' => null,
                            ],
                            [
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 60,
                                'nicotine_strengths' => [0, 3, 6],
                                'flavour_id' => null,
                            ]
                        ]
                    ],
                    [
                        'name' => 'Strawberry Guava Jackfruit',
                        'category' => 'Fruits',
                        'components' => ['Strawberry', 'Guava', 'Jackfruit'],
                        'liquids' => [
                            [
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'nicotine_strengths' => [20, 35, 50],
                                'flavour_id' => null,
                            ],
                            [
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 60,
                                'nicotine_strengths' => [0, 3, 6],
                                'flavour_id' => null,
                            ]
                        ]
                    ],
                    [
                        'name' => 'Blueberry Raspberry Lemon',
                        'category' => 'Fruits',
                        'components' => ['Blueberry', 'Raspberry', 'Lemon'],
                        'liquids' => [
                            [
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'nicotine_strengths' => [20, 35, 50],
                                'flavour_id' => null,
                            ],
                            [
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 60,
                                'nicotine_strengths' => [0, 3, 6],
                                'flavour_id' => null,
                            ]
                        ]
                    ],
                ],
            ],

            'Vampire Vape' => [
                'country' => 'United Kingdom',
                'flavors' => [
                    [
                        'name' => 'Heisenberg',
                        'category' => 'Menthol & Mint',
                        'components' => ['Blueberry', 'Anise', 'Menthol'],
                        'liquids' => [
                            [
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'nicotine_strengths' => [10, 20],
                                'flavour_id' => null,
                            ],
                            [
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 50,
                                'nicotine_strengths' => [0, 3, 6, 12],
                                'flavour_id' => null,
                            ]
                        ]
                    ],
                    [
                        'name' => 'Pinkman',
                        'category' => 'Fruits',
                        'components' => ['Mixed Fruits', 'Citrus'],
                        'liquids' => [
                            [
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'nicotine_strengths' => [10, 20],
                                'flavour_id' => null,
                            ],
                            [
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 50,
                                'nicotine_strengths' => [0, 3, 6, 12],
                                'flavour_id' => null,
                            ]
                        ]
                    ],
                    [
                        'name' => 'Blood Sukka',
                        'category' => 'Fruits',
                        'components' => ['Cherry', 'Red Berries', 'Menthol'],
                        'liquids' => [
                            [
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'nicotine_strengths' => [10, 20],
                                'flavour_id' => null,
                            ],
                            [
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 50,
                                'nicotine_strengths' => [0, 3, 6, 12],
                                'flavour_id' => null,
                            ]
                        ]
                    ],
                    [
                        'name' => 'Bat Juice',
                        'category' => 'Fruits',
                        'components' => ['Mixed Berries', 'Anise'],
                        'liquids' => [
                            [
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'nicotine_strengths' => [10, 20],
                                'flavour_id' => null,
                            ],
                            [
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 50,
                                'nicotine_strengths' => [0, 3, 6, 12],
                                'flavour_id' => null,
                            ]
                        ]
                    ],
                ],
            ],


            'Element E-Liquid' => [
                'country' => 'United States',
                'flavors' => [
                    [
                        'name' => 'Pink Lemonade',
                        'category' => 'Drinks & Beverages',
                        'components' => ['Lemonade', 'Raspberry'],
                        'liquids' => [
                            [
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'nicotine_strengths' => [20, 35, 50],
                                'flavour_id' => null,
                            ],
                            [
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 60,
                                'nicotine_strengths' => [0, 3, 6],
                                'flavour_id' => null,
                            ]
                        ]
                    ],
                    [
                        'name' => 'Watermelon Chill',
                        'category' => 'Fruits',
                        'components' => ['Watermelon', 'Menthol'],
                        'liquids' => [
                            [
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'nicotine_strengths' => [20, 35, 50],
                                'flavour_id' => null,
                            ],
                            [
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 60,
                                'nicotine_strengths' => [0, 3, 6],
                                'flavour_id' => null,
                            ]
                        ]
                    ],
                    [
                        'name' => 'Fresh Squeeze',
                        'category' => 'Drinks & Beverages',
                        'components' => ['Orange Juice'],
                        'liquids' => [
                            [
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'nicotine_strengths' => [20, 35],
                                'flavour_id' => null,
                            ],
                            [
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 60,
                                'nicotine_strengths' => [0, 3, 6],
                                'flavour_id' => null,
                            ]
                        ]
                    ],
                    [
                        'name' => 'Key Lime Cookie',
                        'category' => 'Bakery',
                        'components' => ['Key Lime', 'Cookie'],
                        'liquids' => [
                            [
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'nicotine_strengths' => [20, 35],
                                'flavour_id' => null,
                            ],
                            [
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 60,
                                'nicotine_strengths' => [0, 3, 6],
                                'flavour_id' => null,
                            ]
                        ]
                    ],
                ],
            ],

            'IVG' => [
                'country' => 'United Kingdom',
                'flavors' => [
                    [
                        'name' => 'Summer Blaze',
                        'category' => 'Fruits',
                        'components' => ['Peach', 'Berries', 'Lemonade'],
                        'liquids' => [
                            [
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'nicotine_strengths' => [10, 20],
                                'flavour_id' => null,
                            ],
                            [
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 50,
                                'nicotine_strengths' => [0, 3, 6, 12],
                                'flavour_id' => null,
                            ]
                        ]
                    ],
                    [
                        'name' => 'Bubblegum Millions',
                        'category' => 'Candy & Sweets',
                        'components' => ['Bubblegum', 'Candy'],
                        'liquids' => [
                            [
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'nicotine_strengths' => [10, 20],
                                'flavour_id' => null,
                            ],
                            [
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 50,
                                'nicotine_strengths' => [0, 3, 6],
                                'flavour_id' => null,
                            ]
                        ]
                    ],
                    [
                        'name' => 'Cola Ice',
                        'category' => 'Drinks & Beverages',
                        'components' => ['Cola', 'Menthol'],
                        'liquids' => [
                            [
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'nicotine_strengths' => [10, 20],
                                'flavour_id' => null,
                            ],
                            [
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 50,
                                'nicotine_strengths' => [0, 3, 6],
                                'flavour_id' => null,
                            ]
                        ]
                    ],
                    [
                        'name' => 'Riberry Lemonade',
                        'category' => 'Drinks & Beverages',
                        'components' => ['Blackcurrant', 'Citrus Lemonade'],
                        'liquids' => [
                            [
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'nicotine_strengths' => [10, 20],
                                'flavour_id' => null,
                            ],
                            [
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 50,
                                'nicotine_strengths' => [0, 3, 6, 12],
                                'flavour_id' => null,
                            ]
                        ]
                    ],
                ],
            ],

            'Charlies Chalk Dust' => [
                'country' => 'United States',
                'flavors' => [
                    [
                        'name' => 'Campfire',
                        'category' => 'Desserts',
                        'components' => ['Marshmallow', 'Chocolate', 'Graham Cracker'],
                        'liquids' => [
                            [
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'nicotine_strengths' => [20, 35],
                                'flavour_id' => null,
                            ],
                            [
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 60,
                                'nicotine_strengths' => [0, 3, 6],
                                'flavour_id' => null,
                            ]
                        ]
                    ],
                    [
                        'name' => 'Head Bangin’ Boogie',
                        'category' => 'Fruits',
                        'components' => ['Blueberry', 'Tropical Fruits'],
                        'liquids' => [
                            [
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'nicotine_strengths' => [20, 35],
                                'flavour_id' => null,
                            ],
                            [
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 60,
                                'nicotine_strengths' => [0, 3, 6],
                                'flavour_id' => null,
                            ]
                        ]
                    ],
                    [
                        'name' => 'Mr. Meringue',
                        'category' => 'Desserts',
                        'components' => ['Lemon', 'Meringue Pie'],
                        'liquids' => [
                            [
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'nicotine_strengths' => [20, 35],
                                'flavour_id' => null,
                            ],
                            [
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 60,
                                'nicotine_strengths' => [0, 3, 6],
                                'flavour_id' => null,
                            ]
                        ]
                    ],
                    [
                        'name' => 'Mustache Milk',
                        'category' => 'Drinks & Beverages',
                        'components' => ['Cereal', 'Milk'],
                        'liquids' => [
                            [
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'nicotine_strengths' => [20, 35],
                                'flavour_id' => null,
                            ],
                            [
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 60,
                                'nicotine_strengths' => [0, 3, 6],
                                'flavour_id' => null,
                            ]
                        ]
                    ],
                ],
            ],

            'Twelve Monkeys' => [
                'country' => 'Canada',
                'flavors' => [
                    [
                        'name' => 'Kanzi',
                        'category' => 'Fruits',
                        'components' => ['Watermelon', 'Strawberry', 'Kiwi'],
                        'liquids' => [
                            [
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'nicotine_strengths' => [20, 35],
                                'flavour_id' => null,
                            ],
                            [
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 60,
                                'nicotine_strengths' => [0, 3, 6],
                                'flavour_id' => null,
                            ]
                        ]
                    ],
                    [
                        'name' => 'Tropika',
                        'category' => 'Fruits',
                        'components' => ['Lychee', 'Papaya', 'Passionfruit'],
                        'liquids' => [
                            [
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'nicotine_strengths' => [20, 35],
                                'flavour_id' => null,
                            ],
                            [
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 60,
                                'nicotine_strengths' => [0, 3, 6],
                                'flavour_id' => null,
                            ]
                        ]
                    ],
                    [
                        'name' => 'Mangabeys',
                        'category' => 'Fruits',
                        'components' => ['Mango', 'Pineapple', 'Guava'],
                        'liquids' => [
                            [
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'nicotine_strengths' => [20, 35],
                                'flavour_id' => null,
                            ],
                            [
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 60,
                                'nicotine_strengths' => [0, 3, 6],
                                'flavour_id' => null,
                            ]
                        ]
                    ],
                    [
                        'name' => 'Harambae',
                        'category' => 'Fruits',
                        'components' => ['Grapefruit', 'Lemon', 'Lime', 'Blood Orange'],
                        'liquids' => [
                            [
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'nicotine_strengths' => [20, 35],
                                'flavour_id' => null,
                            ],
                            [
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 60,
                                'nicotine_strengths' => [0, 3, 6],
                                'flavour_id' => null,
                            ]
                        ]
                    ],
                ],
            ],


            'Sadboy' => [
                'country' => 'United States',
                'flavors' => [
                    [
                        'name' => 'Butter Cookie',
                        'category' => 'Desserts',
                        'components' => ['Butter', 'Shortbread Cookie', 'Sugar'],
                        'liquids' => [
                            [
                                'liquid_id' => 3001,
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'flavour_id' => null,
                                'nicotine_strengths' => [20, 35, 50]
                            ],
                            [
                                'liquid_id' => 3002,
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 60,
                                'flavour_id' => null,
                                'nicotine_strengths' => [0, 3, 6]
                            ]
                        ],
                    ],
                    [
                        'name' => 'Pumpkin Cookie',
                        'category' => 'Desserts',
                        'components' => ['Pumpkin', 'Spice', 'Cookie'],
                        'liquids' => [
                            [
                                'liquid_id' => 3003,
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'flavour_id' => null,
                                'nicotine_strengths' => [20, 35]
                            ],
                            [
                                'liquid_id' => 3004,
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 60,
                                'flavour_id' => null,
                                'nicotine_strengths' => [0, 3, 6]
                            ]
                        ],
                    ],
                    [
                        'name' => 'Nola Bar',
                        'category' => 'Desserts',
                        'components' => ['Strawberry', 'Cream', 'Graham Cracker'],
                        'liquids' => [
                            [
                                'liquid_id' => 3005,
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'flavour_id' => null,
                                'nicotine_strengths' => [20, 35, 50]
                            ],
                            [
                                'liquid_id' => 3006,
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 60,
                                'flavour_id' => null,
                                'nicotine_strengths' => [0, 3, 6]
                            ]
                        ],
                    ],
                ],
            ],

            'Air Factory' => [
                'country' => 'United States',
                'flavors' => [
                    [
                        'name' => 'Blue Razz',
                        'category' => 'Candy & Sweets',
                        'components' => ['Blue Raspberry', 'Candy'],
                        'liquids' => [
                            [
                                'liquid_id' => 3007,
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'flavour_id' => null,
                                'nicotine_strengths' => [25, 50]
                            ],
                            [
                                'liquid_id' => 3008,
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 100,
                                'flavour_id' => null,
                                'nicotine_strengths' => [0, 3, 6]
                            ]
                        ],
                    ],
                    [
                        'name' => 'Mystery',
                        'category' => 'Candy & Sweets',
                        'components' => ['Assorted Fruits', 'Candy'],
                        'liquids' => [
                            [
                                'liquid_id' => 3009,
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'flavour_id' => null,
                                'nicotine_strengths' => [25, 50]
                            ],
                            [
                                'liquid_id' => 3010,
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 100,
                                'flavour_id' => null,
                                'nicotine_strengths' => [0, 3, 6]
                            ]
                        ],
                    ],
                    [
                        'name' => 'Watermelon Wave',
                        'category' => 'Fruits',
                        'components' => ['Watermelon', 'Cooling'],
                        'liquids' => [
                            [
                                'liquid_id' => 3011,
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'flavour_id' => null,
                                'nicotine_strengths' => [25, 50]
                            ],
                            [
                                'liquid_id' => 3012,
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 100,
                                'flavour_id' => null,
                                'nicotine_strengths' => [0, 3, 6]
                            ]
                        ],
                    ],
                ],
            ],

            'Zeus Juice' => [
                'country' => 'United Kingdom',
                'flavors' => [
                    [
                        'name' => 'Black Reloaded',
                        'category' => 'Fruits',
                        'components' => ['Blackcurrant', 'Blackberry', 'Lemon'],
                        'liquids' => [
                            [
                                'liquid_id' => 3013,
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'flavour_id' => null,
                                'nicotine_strengths' => [10, 20]
                            ],
                            [
                                'liquid_id' => 3014,
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 50,
                                'flavour_id' => null,
                                'nicotine_strengths' => [0, 3, 6]
                            ]
                        ],
                    ],
                    [
                        'name' => 'Golden Elixir',
                        'category' => 'Desserts',
                        'components' => ['Custard', 'Vanilla', 'Biscuit'],
                        'liquids' => [
                            [
                                'liquid_id' => 3015,
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'flavour_id' => null,
                                'nicotine_strengths' => [10, 20]
                            ],
                            [
                                'liquid_id' => 3016,
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 50,
                                'flavour_id' => null,
                                'nicotine_strengths' => [0, 3, 6]
                            ]
                        ],
                    ],
                    [
                        'name' => 'Pink Grapefruit',
                        'category' => 'Fruits',
                        'components' => ['Grapefruit', 'Citrus'],
                        'liquids' => [
                            [
                                'liquid_id' => 3017,
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'flavour_id' => null,
                                'nicotine_strengths' => [10, 20]
                            ],
                            [
                                'liquid_id' => 3018,
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 50,
                                'flavour_id' => null,
                                'nicotine_strengths' => [0, 3, 6]
                            ]
                        ],
                    ],
                ],
            ],

            'Riot Squad' => [ 
                'country' => 'United Kingdom',
                'flavors' => [
                    [
                        'name' => 'Pink Grenade',
                        'category' => 'Fruits',
                        'components' => ['Strawberry', 'Lemon'],
                        'liquids' => [
                            [
                                'liquid_id' => 3019,
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'flavour_id' => null,
                                'nicotine_strengths' => [11, 20]
                            ],
                            [
                                'liquid_id' => 3020,
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 50,
                                'flavour_id' => null,
                                'nicotine_strengths' => [0, 3, 6]
                            ]
                        ],
                    ],
                    [
                        'name' => 'Punk Grenade Mango Lime',
                        'category' => 'Fruits',
                        'components' => ['Mango', 'Lime'],
                        'liquids' => [
                            [
                                'liquid_id' => 3021,
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'flavour_id' => null,
                                'nicotine_strengths' => [11, 20]
                            ],
                            [
                                'liquid_id' => 3022,
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 50,
                                'flavour_id' => null,
                                'nicotine_strengths' => [0, 3, 6]
                            ]
                        ],
                    ],
                    [
                        'name' => 'Blue Burst',
                        'category' => 'Menthol & Ice',
                        'components' => ['Blue Raspberry', 'Menthol'],
                        'liquids' => [
                            [
                                'liquid_id' => 3023,
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'flavour_id' => null,
                                'nicotine_strengths' => [11, 20]
                            ],
                            [
                                'liquid_id' => 3024,
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 50,
                                'flavour_id' => null,
                                'nicotine_strengths' => [0, 3, 6]
                            ]
                        ],
                    ],
                ],
            ],


         

            // Egyptian Brands (local market)
           'Madnez' => [
            'country' => 'Egypt',
            'flavors' => [
                [
                    'name' => 'Milk',
                    'category' => 'Desserts',
                    'components' => ['Strawberry', 'Milk Cream'],
                    'liquids' => [
                        [
                            'nicotine_type' => 'Salt',
                            'vape_style' => 'MTL',
                            'vg_pg_ratio' => '50/50',
                            'bottle_size_ml' => 30,
                            'nicotine_strengths' => [20, 35],
                            'flavour_id' => null,
                        ],
                        [
                            'nicotine_type' => 'Freebase',
                            'vape_style' => 'DL',
                            'vg_pg_ratio' => '70/30',
                            'bottle_size_ml' => 60,
                            'nicotine_strengths' => [0, 3, 6],
                            'flavour_id' => null,
                        ],
                    ],
                ],
                [
                    'name' => 'Castaway',
                    'category' => 'Fruits',
                    'components' => ['Cantaloupe'],
                    'liquids' => [
                        [
                            'nicotine_type' => 'Salt',
                            'vape_style' => 'MTL',
                            'vg_pg_ratio' => '50/50',
                            'bottle_size_ml' => 30,
                            'nicotine_strengths' => [20, 35],
                            'flavour_id' => null,
                        ],
                        [
                            'nicotine_type' => 'Freebase',
                            'vape_style' => 'DL',
                            'vg_pg_ratio' => '70/30',
                            'bottle_size_ml' => 60,
                            'nicotine_strengths' => [0, 3, 6],
                            'flavour_id' => null,
                        ],
                    ],
                ],
                [
                    'name' => 'Arabian Nights',
                    'category' => 'Drinks & Beverages',
                    'components' => ['Coffee', 'Spices'],
                    'liquids' => [
                        [
                            'nicotine_type' => 'Salt',
                            'vape_style' => 'MTL',
                            'vg_pg_ratio' => '50/50',
                            'bottle_size_ml' => 30,
                            'nicotine_strengths' => [20, 35],
                            'flavour_id' => null,
                        ],
                        [
                            'nicotine_type' => 'Freebase',
                            'vape_style' => 'DL',
                            'vg_pg_ratio' => '70/30',
                            'bottle_size_ml' => 60,
                            'nicotine_strengths' => [0, 3, 6],
                            'flavour_id' => null,
                        ],
                    ],
                ],
            ],
                    ],

            'Steam Bird' => [
                'country' => 'Egypt',
                'flavors' => [
                    [
                        'name' => 'Porsche',
                        'category' => 'Tobacco',
                        'components' => ['Tobacco Blend'],
                        'liquids' => [
                            [
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'nicotine_strengths' => [20, 35],
                                'flavour_id' => null,
                            ],
                            [
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 60,
                                'nicotine_strengths' => [0, 3, 6],
                                'flavour_id' => null,
                            ],
                        ],
                    ],
                    [
                        'name' => 'Jaguar',
                        'category' => 'Bakery',
                        'components' => ['Apple Pie', 'Cookies'],
                        'liquids' => [
                            [
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'nicotine_strengths' => [20, 35],
                                'flavour_id' => null,
                            ],
                            [
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 60,
                                'nicotine_strengths' => [0, 3, 6],
                                'flavour_id' => null,
                            ],
                        ],
                    ],
                ],
            ],



            'Valkyrie' => [
                'country' => 'Egypt',
                'flavors' => [
                    [
                        'name' => 'Plain Tobacco',
                        'category' => 'Tobacco',
                        'components' => ['Tobacco']
                    ],
                    [
                        'name' => 'Tiramisu',
                        'category' => 'Desserts',
                        'components' => ['Coffee', 'Cocoa', 'Cream']
                    ],
                    [
                        'name' => 'Cheesecake',
                        'category' => 'Desserts',
                        'components' => ['Cheesecake', 'Cream']
                    ],
                ],
            ],

            'Cloud Chasers Egypt' => [
                'country' => 'Egypt',
                'flavors' => [
                    ['name' => 'Pharaoh’s Mango', 'category' => 'Fruits', 'components' => ['Mango']],
                    ['name' => 'Lotus Berries', 'category' => 'Fruits', 'components' => ['Blueberry', 'Blackberry']],
                    ['name' => 'Mint Nile Breeze', 'category' => 'Menthol & Ice', 'components' => ['Mint', 'Ice']],
                ],
            ],

             'Nilus Vape' => [
                    'country' => 'Egypt',
                    'flavors' => [
                        ['name' => 'Pomegranate Rush', 'category' => 'Fruits', 'components' => ['Pomegranate']],
                        ['name' => 'Karkadeh Freeze', 'category' => 'Drinks & Beverages', 'components' => ['Hibiscus', 'Ice']],
                        ['name' => 'Om Ali Delight', 'category' => 'Desserts', 'components' => ['Pastry', 'Milk', 'Nuts']],
                    ],
            ],

            'Pyramid Juice Co.' => [
                'country' => 'Egypt',
                'flavors' => [
                    ['name' => 'Sphinx Grape', 'category' => 'Fruits', 'components' => ['Red Grape']],
                    ['name' => 'Desert Date Mix', 'category' => 'Fruits', 'components' => ['Dates', 'Honey']],
                    ['name' => 'Cleopatra’s Mint', 'category' => 'Menthol & Ice', 'components' => ['Mint']],
                ],
            ],

            'Kemet Liquids' => [
                'country' => 'Egypt',
                'flavors' => [
                    ['name' => 'Papyrus Peach', 'category' => 'Fruits', 'components' => ['Peach']],
                    ['name' => 'Basbousa Bliss', 'category' => 'Desserts', 'components' => ['Semolina Cake', 'Honey']],
                    ['name' => 'Mint Shisha', 'category' => 'Menthol & Ice', 'components' => ['Mint', 'Cooling']],
                ],
            ],

            'Vape Station' => [
    'country' => 'Egypt',
    'flavors' => [
        [
            'id' => 201,
            'name' => 'Blue Ice',
            'category' => 'Fruits',
            'components' => ['Blueberry', 'Menthol'],
            'liquids' => [
                [
                    'id' => 20101,
                    'flavour_id' => 201,
                    'nicotine_type' => 'Freebase',
                    'nicotine_strengths' => [3, 6, 12],
                    'vape_style' => 'DL',
                    'vg_pg_ratio' => '70/30',
                    'bottle_size_ml' => 60,
                ],
                [
                    'id' => 20102,
                    'flavour_id' => 201,
                    'nicotine_type' => 'Nicotine Salt',
                    'nicotine_strengths' => [20, 35, 50],
                    'vape_style' => 'MTL',
                    'vg_pg_ratio' => '50/50',
                    'bottle_size_ml' => 30,
                ],
            ],
        ],
        [
            'id' => 202,
            'name' => 'Mango Tango',
            'category' => 'Fruits',
            'components' => ['Mango', 'Tangerine'],
            'liquids' => [
                [
                    'id' => 20201,
                    'flavour_id' => 202,
                    'nicotine_type' => 'Freebase',
                    'nicotine_strengths' => [3, 6],
                    'vape_style' => 'DL',
                    'vg_pg_ratio' => '70/30',
                    'bottle_size_ml' => 60,
                ],
                [
                    'id' => 20202,
                    'flavour_id' => 202,
                    'nicotine_type' => 'Nicotine Salt',
                    'nicotine_strengths' => [25, 50],
                    'vape_style' => 'MTL',
                    'vg_pg_ratio' => '50/50',
                    'bottle_size_ml' => 30,
                ],
            ],
        ],
        [
            'id' => 203,
            'name' => 'Grape Blast',
            'category' => 'Fruits',
            'components' => ['Red Grape', 'Ice'],
            'liquids' => [
                [
                    'id' => 20301,
                    'flavour_id' => 203,
                    'nicotine_type' => 'Freebase',
                    'nicotine_strengths' => [3, 6, 12],
                    'vape_style' => 'DL',
                    'vg_pg_ratio' => '70/30',
                    'bottle_size_ml' => 60,
                ],
                [
                    'id' => 20302,
                    'flavour_id' => 203,
                    'nicotine_type' => 'Nicotine Salt',
                    'nicotine_strengths' => [20, 35],
                    'vape_style' => 'MTL',
                    'vg_pg_ratio' => '50/50',
                    'bottle_size_ml' => 30,
                ],
            ],
        ],
        [
            'id' => 204,
            'name' => 'Double Apple',
            'category' => 'Fruits',
            'components' => ['Green Apple', 'Red Apple'],
            'liquids' => [
                [
                    'id' => 20401,
                    'flavour_id' => 204,
                    'nicotine_type' => 'Freebase',
                    'nicotine_strengths' => [3, 6, 12],
                    'vape_style' => 'DL',
                    'vg_pg_ratio' => '70/30',
                    'bottle_size_ml' => 60,
                ],
                [
                    'id' => 20402,
                    'flavour_id' => 204,
                    'nicotine_type' => 'Nicotine Salt',
                    'nicotine_strengths' => [25, 50],
                    'vape_style' => 'MTL',
                    'vg_pg_ratio' => '50/50',
                    'bottle_size_ml' => 30,
                ],
            ],
        ],
        [
            'id' => 205,
            'name' => 'Cola Ice',
            'category' => 'Drinks & Beverages',
            'components' => ['Cola', 'Ice'],
            'liquids' => [
                [
                    'id' => 20501,
                    'flavour_id' => 205,
                    'nicotine_type' => 'Freebase',
                    'nicotine_strengths' => [3, 6],
                    'vape_style' => 'DL',
                    'vg_pg_ratio' => '70/30',
                    'bottle_size_ml' => 60,
                ],
                [
                    'id' => 20502,
                    'flavour_id' => 205,
                    'nicotine_type' => 'Nicotine Salt',
                    'nicotine_strengths' => [20, 35],
                    'vape_style' => 'MTL',
                    'vg_pg_ratio' => '50/50',
                    'bottle_size_ml' => 30,
                ],
            ],
        ],
    ],
            ],

            'Frisky' => [
                'country' => 'Egypt',
                'flavors' => [
                    [
                        'name' => 'Raspberry Lemonade',
                        'category' => 'Drinks & Beverages',
                        'components' => ['Raspberry', 'Lemonade'],
                        'liquids' => [
                            [
                                'liquid_id' => 1,
                                'nicotine_type' => 'Freebase', // Freebase / Salt
                                'vape_style' => 'MTL',        // MTL / DL
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 60,
                                'flavour_id' => 101,
                                'nicotine_strengths' => [0, 3, 6] // mg
                            ],
                            [
                                'liquid_id' => 2,
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'flavour_id' => 101,
                                'nicotine_strengths' => [20, 35, 50]
                            ],
                        ],
                    ],
                    [
                        'name' => 'Watermelon Ice',
                        'category' => 'Fruits',
                        'components' => ['Watermelon', 'Menthol'],
                        'liquids' => [
                            [
                                'liquid_id' => 3,
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'flavour_id' => 102,
                                'nicotine_strengths' => [20, 35, 50]
                            ],
                            [
                                'liquid_id' => 4,
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 60,
                                'flavour_id' => 102,
                                'nicotine_strengths' => [0, 3, 6]
                            ],
                        ],
                    ],
                    [
                        'name' => 'Strawberry Cream',
                        'category' => 'Desserts',
                        'components' => ['Strawberry', 'Cream'],
                        'liquids' => [
                            [
                                'liquid_id' => 5,
                                'nicotine_type' => 'Salt',
                                'vape_style' => 'MTL',
                                'vg_pg_ratio' => '50/50',
                                'bottle_size_ml' => 30,
                                'flavour_id' => 103,
                                'nicotine_strengths' => [20, 35]
                            ],
                            [
                                'liquid_id' => 6,
                                'nicotine_type' => 'Freebase',
                                'vape_style' => 'DL',
                                'vg_pg_ratio' => '70/30',
                                'bottle_size_ml' => 60,
                                'flavour_id' => 103,
                                'nicotine_strengths' => [0, 3, 6]
                            ],
                        ],
                    ],
                ],
            ],


            'Sphinx Vape' => [
            'country' => 'Egypt',
            'flavors' => [
                [
                    'name' => 'Nile Queen',
                    'category' => 'Fruits',
                    'components' => ['Guava', 'Pomegranate'],
                    'liquids' => [
                        [
                            'liquid_id' => 4001,
                            'nicotine_type' => 'Salt',
                            'vape_style' => 'MTL',
                            'vg_pg_ratio' => '50/50',
                            'bottle_size_ml' => 30,
                            'flavour_id' => null,
                            'nicotine_strengths' => [20, 35]
                        ],
                        [
                            'liquid_id' => 4002,
                            'nicotine_type' => 'Freebase',
                            'vape_style' => 'DL',
                            'vg_pg_ratio' => '70/30',
                            'bottle_size_ml' => 60,
                            'flavour_id' => null,
                            'nicotine_strengths' => [0, 3, 6]
                        ]
                    ],
                ],
                [
                    'name' => 'Pharaoh\'s Kiss',
                    'category' => 'Desserts',
                    'components' => ['Date Molasses', 'Tahini', 'Coconut'],
                    'liquids' => [
                        [
                            'liquid_id' => 4003,
                            'nicotine_type' => 'Salt',
                            'vape_style' => 'MTL',
                            'vg_pg_ratio' => '50/50',
                            'bottle_size_ml' => 30,
                            'flavour_id' => null,
                            'nicotine_strengths' => [20, 35]
                        ],
                        [
                            'liquid_id' => 4004,
                            'nicotine_type' => 'Freebase',
                            'vape_style' => 'DL',
                            'vg_pg_ratio' => '70/30',
                            'bottle_size_ml' => 60,
                            'flavour_id' => null,
                            'nicotine_strengths' => [0, 3, 6]
                        ]
                    ],
                ],
                [
                    'name' => 'Red Sea Breeze',
                    'category' => 'Menthol & Ice',
                    'components' => ['Cantaloupe', 'Mint'],
                    'liquids' => [
                        [
                            'liquid_id' => 4005,
                            'nicotine_type' => 'Salt',
                            'vape_style' => 'MTL',
                            'vg_pg_ratio' => '50/50',
                            'bottle_size_ml' => 30,
                            'flavour_id' => null,
                            'nicotine_strengths' => [20, 35]
                        ],
                        [
                            'liquid_id' => 4006,
                            'nicotine_type' => 'Freebase',
                            'vape_style' => 'DL',
                            'vg_pg_ratio' => '70/30',
                            'bottle_size_ml' => 60,
                            'flavour_id' => null,
                            'nicotine_strengths' => [0, 3, 6]
                        ]
                    ],
                ],
            ],
        ],

        'Cairo Clouds' => [
            'country' => 'Egypt',
            'flavors' => [
                [
                    'name' => 'Karkade Iced Tea',
                    'category' => 'Drinks & Beverages',
                    'components' => ['Hibiscus', 'Cinnamon', 'Ice'],
                    'liquids' => [
                        [
                            'liquid_id' => 4007,
                            'nicotine_type' => 'Salt',
                            'vape_style' => 'MTL',
                            'vg_pg_ratio' => '50/50',
                            'bottle_size_ml' => 30,
                            'flavour_id' => null,
                            'nicotine_strengths' => [25, 40]
                        ],
                        [
                            'liquid_id' => 4008,
                            'nicotine_type' => 'Freebase',
                            'vape_style' => 'DL',
                            'vg_pg_ratio' => '80/20',
                            'bottle_size_ml' => 60,
                            'flavour_id' => null,
                            'nicotine_strengths' => [0, 3]
                        ]
                    ],
                ],
                [
                    'name' => 'Sohalia',
                    'category' => 'Fruits',
                    'components' => ['Sugar Apple', 'Cream'],
                    'liquids' => [
                        [
                            'liquid_id' => 4009,
                            'nicotine_type' => 'Salt',
                            'vape_style' => 'MTL',
                            'vg_pg_ratio' => '50/50',
                            'bottle_size_ml' => 30,
                            'flavour_id' => null,
                            'nicotine_strengths' => [25, 40]
                        ],
                        [
                            'liquid_id' => 4010,
                            'nicotine_type' => 'Freebase',
                            'vape_style' => 'DL',
                            'vg_pg_ratio' => '80/20',
                            'bottle_size_ml' => 60,
                            'flavour_id' => null,
                            'nicotine_strengths' => [0, 3]
                        ]
                    ],
                ],
                [
                    'name' => 'Desert Fog',
                    'category' => 'Tobacco',
                    'components' => ['Caramel Tobacco', 'Hazelnut', 'Vanilla'],
                    'liquids' => [
                        [
                            'liquid_id' => 4011,
                            'nicotine_type' => 'Salt',
                            'vape_style' => 'MTL',
                            'vg_pg_ratio' => '50/50',
                            'bottle_size_ml' => 30,
                            'flavour_id' => null,
                            'nicotine_strengths' => [25, 40]
                        ],
                        [
                            'liquid_id' => 4012,
                            'nicotine_type' => 'Freebase',
                            'vape_style' => 'DL',
                            'vg_pg_ratio' => '80/20',
                            'bottle_size_ml' => 60,
                            'flavour_id' => null,
                            'nicotine_strengths' => [0, 3, 6]
                        ]
                    ],
                ],
            ],
        ],

        'Doozy Vape' => [
            'country' => 'United Kingdom',
            'flavors' => [
                [
                    'name' => 'Liquid Gold',
                    'category' => 'Desserts',
                    'components' => ['Vanilla Custard', 'Caramel', 'Biscuit'],
                    'liquids' => [
                        [
                            'liquid_id' => 5001,
                            'nicotine_type' => 'Salt',
                            'vape_style' => 'MTL',
                            'vg_pg_ratio' => '50/50',
                            'bottle_size_ml' => 30,
                            'flavour_id' => null,
                            'nicotine_strengths' => [10, 20]
                        ],
                        [
                            'liquid_id' => 5002,
                            'nicotine_type' => 'Freebase',
                            'vape_style' => 'DL',
                            'vg_pg_ratio' => '70/30',
                            'bottle_size_ml' => 50,
                            'flavour_id' => null,
                            'nicotine_strengths' => [0, 3, 6]
                        ]
                    ],
                ],
                [
                    'name' => 'Rainbow',
                    'category' => 'Candy & Sweets',
                    'components' => ['Sherbet', 'Rainbow Candy'],
                    'liquids' => [
                        [
                            'liquid_id' => 5003,
                            'nicotine_type' => 'Salt',
                            'vape_style' => 'MTL',
                            'vg_pg_ratio' => '50/50',
                            'bottle_size_ml' => 30,
                            'flavour_id' => null,
                            'nicotine_strengths' => [10, 20]
                        ],
                        [
                            'liquid_id' => 5004,
                            'nicotine_type' => 'Freebase',
                            'vape_style' => 'DL',
                            'vg_pg_ratio' => '70/30',
                            'bottle_size_ml' => 50,
                            'flavour_id' => null,
                            'nicotine_strengths' => [0, 3, 6]
                        ]
                    ],
                ],
            ],
        ],

        'Pod Salt' => [
            'country' => 'United Kingdom',
            'flavors' => [
                [
                    'name' => 'Ezee Apple',
                    'category' => 'Fruits',
                    'components' => ['Green Apple'],
                    'liquids' => [
                        [
                            'liquid_id' => 5005,
                            'nicotine_type' => 'Salt',
                            'vape_style' => 'MTL',
                            'vg_pg_ratio' => '50/50',
                            'bottle_size_ml' => 30,
                            'flavour_id' => null,
                            'nicotine_strengths' => [10, 20]
                        ]
                        // Often Pod Salt focuses on Salt Nic only for pod systems
                    ],
                ],
                [
                    'name' => 'Ezee Grape',
                    'category' => 'Fruits',
                    'components' => ['Grape'],
                    'liquids' => [
                        [
                            'liquid_id' => 5006,
                            'nicotine_type' => 'Salt',
                            'vape_style' => 'MTL',
                            'vg_pg_ratio' => '50/50',
                            'bottle_size_ml' => 30,
                            'flavour_id' => null,
                            'nicotine_strengths' => [10, 20]
                        ]
                    ],
                ],
                [
                    'name' => 'Caramel Tobacco',
                    'category' => 'Tobacco',
                    'components' => ['Caramel', 'Tobacco'],
                    'liquids' => [
                        [
                            'liquid_id' => 5007,
                            'nicotine_type' => 'Salt',
                            'vape_style' => 'MTL',
                            'vg_pg_ratio' => '50/50',
                            'bottle_size_ml' => 30,
                            'flavour_id' => null,
                            'nicotine_strengths' => [10, 20]
                        ]
                    ],
                ],
            ],
        ],
    ];
        foreach($brands as $brand=>$details){
            $brand = Brand::firstOrCreate(['name'=>$brand , 'country'=>$details['country']]);

            foreach($details['flavors'] as $flavordetails){
                $flavour = Flavour::create(['brand_id'=>$brand->id , 'name'=>$flavordetails['name']]);
                $categoryValue = $flavordetails['category'];
                $category = Category::where('name',$categoryValue)->first();
                if(!isset($category)){
                    $category = Category::create(['name'=>$categoryValue]);
                }
                $categoryID = $category->id ;
                $componentsArray = $flavordetails['components'];
                foreach($componentsArray as $component){
                    $componentModel = Component::where('name',$component)->first();
                    if(!isset($componentModel)){
                        $componentModel = Component::create(['name'=>$component , 'category_id'=>$categoryID]);
                    }
                    $componentID = $componentModel->id ;
                    FlavourComponent::create(['flavour_id'=>$flavour->id , 
                    'component_id'=>$componentID]);
                }
                $liquids = $flavordetails['liquids'] ?? [];
                foreach($liquids as $liquid){
                    $liquidModel = Liquid::create([
                        'nicotine_type'=>$liquid['nicotine_type'] , 'vape_style'=>$liquid['vape_style'] , 
                        'vg_pg_ratio'=>$liquid['vg_pg_ratio'] , 'flavour_id'=>$flavour->id ,
                        'bottle_size_ml'=>$liquid['bottle_size_ml']
                    ]);
                    $liquidNicStrength = $liquid['nicotine_strengths'];
                    foreach($liquidNicStrength as $liqStrength){
                        LiquidNicStrength::create(['strength'=>$liqStrength , 'liquid_id'=>$liquidModel->id]);
                    }
                    
                }

            }
        }

    }
}
