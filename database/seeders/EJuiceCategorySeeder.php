<?php

namespace Database\Seeders;

use App\Models\CommonModels\Category;
use App\Models\CommonModels\Component;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EJuiceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear old data
        DB::table('category')->delete();

        // Predefined structure: categories + their components
        $categories = [
                'Fruits' => [
                    'Mango', 'Strawberry', 'Blueberry', 'Watermelon', 'Apple', 'Pineapple',
                    'Banana', 'Peach', 'Raspberry', 'Blackberry', 'Grape', 'Cherry',
                    'Kiwi', 'Dragonfruit', 'Passionfruit', 'Lychee', 'Pear', 'Pomegranate'
                ],

                'Candy & Sweets' => [
                    'Cotton Candy', 'Gummy Bear', 'Bubblegum', 'Sour Candy', 'Caramel',
                    'Marshmallow', 'Licorice', 'Taffy', 'Hard Candy', 'Lollipop'
                ],

                'Desserts' => [
                    'Vanilla Custard', 'Cheesecake', 'Donut', 'Cookies & Cream', 'Pudding',
                    'Tiramisu', 'Brownie', 'Chocolate Mousse', 'Creme Brulee', 'Apple Pie'
                ],

                'Drinks & Beverages' => [
                    'Cola', 'Energy Drink', 'Lemonade', 'Iced Tea', 'Coffee', 'Milkshake',
                    'Hot Chocolate', 'Mojito', 'Smoothie', 'Rum & Coke', 'Whiskey Sour'
                ],

                'Tobacco' => [
                    'Classic Tobacco', 'Cigar', 'Honey Tobacco', 'Vanilla Tobacco',
                    'Cuban Blend', 'American Blend', 'Turkish Tobacco', 'Menthol Tobacco'
                ],

                'Menthol & Mint' => [
                    'Cool Mint', 'Peppermint', 'Spearmint', 'Ice Blast',
                    'Eucalyptus Mint', 'Frosted Berry Mint', 'Wintergreen'
                ],

                'Bakery' => [
                    'Waffle', 'Muffin', 'Pie Crust', 'Croissant',
                    'Danish Pastry', 'Cinnamon Roll', 'Bread Pudding'
                ],

                'Spices & Exotic' => [
                    'Cinnamon', 'Anise', 'Clove', 'Cardamom',
                    'Ginger', 'Nutmeg', 'Star Anise', 'Saffron'
                ],

                'Nuts & Creams' => [
                    'Hazelnut', 'Almond', 'Pistachio', 'Peanut Butter',
                    'Macadamia', 'Cashew', 'Coconut Cream', 'Irish Cream'
                ],

                'Ice Cream & Dairy' => [
                    'Vanilla Ice Cream', 'Strawberry Ice Cream', 'Chocolate Ice Cream',
                    'Mint Choco Chip', 'Butter Pecan', 'Cookies Dough'
                ],

                'Special Blends' => [
                    'Rainbow Mix', 'Unicorn Milk', 'Tropical Fusion',
                    'Berry Blast', 'Summer Breeze', 'Sunset Cocktail'
                ]
            ];


        foreach ($categories as $categoryName => $components) {
            $category = Category::create([
                'name' => $categoryName,
                'description' => "$categoryName flavored e-liquids",
            ]);

            foreach ($components as $componentName) {
                Component::create([
                    'name' => $componentName,
                    'category_id' => $category->id,
                ]);
            }
        }
    }
    }

