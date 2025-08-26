<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\MasterItem;
use App\Models\MasterCategory;

class MasterItemSeeder extends Seeder
{
    public function run()
    {
        // Clear existing data
        DB::table('master_items')->delete();
        DB::table('master_categories')->delete();

        // Create categories first and store their IDs
        $categoryData = [
            'Minyak Bayi',
            'Aromaterapi', 
            'Kesehatan',
            'Perawatan Kulit',
            'Essential Oil',
        ];

        $categoryIds = [];
        foreach ($categoryData as $categoryName) {
            $category = MasterCategory::create(['category_name' => $categoryName]);
            $categoryIds[$categoryName] = $category->category_id;
        }

        // Create items using the actual category IDs
        $items = [
            // Minyak Bayi
            [
                'category_id' => $categoryIds['Minyak Bayi'],
                'name_item' => 'Gentle Baby Cough n Flu',
                'description_item' => 'Minyak bayi yang membantu meredakan batuk dan flu pada anak bayi',
                'ingredient_item' => 'Minyak Eucalyptus, Minyak Lavender, Minyak Kelapa',
                'netweight_item' => '30ml',
                'contain_item' => '1 botol minyak bayi',
                'costprice_item' => 250000,
                'sell_price' => 299000,
                'stock' => 15,
                'unit_item' => 'botol'
            ],
            [
                'category_id' => $categoryIds['Minyak Bayi'],
                'name_item' => 'Gentle Baby Deep Sleep',
                'description_item' => 'Minyak bayi untuk membantu bayi tidur nyenyak',
                'ingredient_item' => 'Minyak Lavender, Minyak Chamomile, Minyak Kelapa',
                'netweight_item' => '30ml',
                'contain_item' => '1 botol minyak bayi',
                'costprice_item' => 200000,
                'sell_price' => 249000,
                'stock' => 8,
                'unit_item' => 'botol'
            ],
            [
                'category_id' => $categoryIds['Minyak Bayi'],
                'name_item' => 'Gentle Baby Bye Bugs',
                'description_item' => 'Minyak bayi yang mengusir nyamuk dan serangga dengan aman',
                'ingredient_item' => 'Minyak Citronella, Minyak Lemongrass, Minyak Kelapa',
                'netweight_item' => '30ml',
                'contain_item' => '1 botol minyak bayi',
                'costprice_item' => 40000,
                'sell_price' => 49000,
                'stock' => 25,
                'unit_item' => 'botol'
            ],
            [
                'category_id' => $categoryIds['Minyak Bayi'],
                'name_item' => 'Gentle Baby LDR Booster',
                'description_item' => 'Minyak bayi dengan formula khusus untuk memperlancar ASI ibu hamil',
                'ingredient_item' => 'Minyak Fennel, Minyak Ginger, Minyak Kelapa',
                'netweight_item' => '50ml',
                'contain_item' => '1 botol minyak bayi',
                'costprice_item' => 500000,
                'sell_price' => 599000,
                'stock' => 5,
                'unit_item' => 'botol'
            ],
            [
                'category_id' => $categoryIds['Minyak Bayi'],
                'name_item' => 'Gentle Baby Tummy Calm',
                'description_item' => 'Minyak bayi untuk meredakan kolik dan perut kembung',
                'ingredient_item' => 'Minyak Fennel, Minyak Peppermint, Minyak Kelapa',
                'netweight_item' => '30ml',
                'contain_item' => '1 botol minyak bayi',
                'costprice_item' => 180000,
                'sell_price' => 220000,
                'stock' => 12,
                'unit_item' => 'botol'
            ],

            // Aromaterapi
            [
                'category_id' => $categoryIds['Aromaterapi'],
                'name_item' => 'Gentle Baby Joy',
                'description_item' => 'Minyak bayi dengan aroma menenangkan untuk membantu atasi bayi rewel',
                'ingredient_item' => 'Minyak Rose, Minyak Jasmine, Minyak Kelapa',
                'netweight_item' => '30ml',
                'contain_item' => '1 botol minyak bayi',
                'costprice_item' => 150000,
                'sell_price' => 189000,
                'stock' => 12,
                'unit_item' => 'botol'
            ],

            // Kesehatan
            [
                'category_id' => $categoryIds['Kesehatan'],
                'name_item' => 'Gentle Baby Immboost',
                'description_item' => 'Minyak bayi untuk meningkatkan daya tahan tubuh dan kesehatan si kecil',
                'ingredient_item' => 'Minyak Orange, Minyak Lemon, Minyak Kelapa',
                'netweight_item' => '30ml',
                'contain_item' => '1 botol minyak bayi',
                'costprice_item' => 70000,
                'sell_price' => 89000,
                'stock' => 18,
                'unit_item' => 'botol'
            ],
        ];

        foreach ($items as $item) {
            MasterItem::create($item);
        }
    }
}
