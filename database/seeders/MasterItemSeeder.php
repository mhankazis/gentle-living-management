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
            'Gentle Baby',
            'Twin Pack',
            'Nyam', 
            'Mamina',
            
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
                'category_id' => $categoryIds['Gentle Baby'],
                'name_item' => 'Gentle Baby Cough n Flu',
                'description_item' => 'Minyak bayi yang membantu meredakan batuk dan flu pada anak bayi',
                'ingredient_item' => 'Minyak Eucalyptus, Minyak Lavender, Minyak Kelapa',
                'netweight_item' => '10ml',
                'contain_item' => '1 botol minyak bayi',
                'costprice_item' => 250000,
                'sell_price' => 299000,
                'stock' => 15,
                'unit_item' => 'botol'
            ],
            [
                'category_id' => $categoryIds['Gentle Baby'],
                'name_item' => 'Gentle Baby Deep Sleep',
                'description_item' => 'Minyak bayi untuk membantu bayi tidur nyenyak',
                'ingredient_item' => 'Minyak Lavender, Minyak Chamomile, Minyak Kelapa',
                'netweight_item' => '10ml',
                'contain_item' => '1 botol minyak bayi',
                'costprice_item' => 200000,
                'sell_price' => 249000,
                'stock' => 8,
                'unit_item' => 'botol'
            ],
            [
                'category_id' => $categoryIds['Gentle Baby'],
                'name_item' => 'Gentle Baby Bye Bugs',
                'description_item' => 'Minyak bayi yang mengusir nyamuk dan serangga dengan aman',
                'ingredient_item' => 'Minyak Citronella, Minyak Lemongrass, Minyak Kelapa',
                'netweight_item' => '10ml',
                'contain_item' => '1 botol minyak bayi',
                'costprice_item' => 40000,
                'sell_price' => 49000,
                'stock' => 25,
                'unit_item' => 'botol'
            ],
            [
                'category_id' => $categoryIds['Gentle Baby'],
                'name_item' => 'Gentle Baby LDR Booster',
                'description_item' => 'Minyak bayi dengan formula khusus untuk memperlancar ASI ibu hamil',
                'ingredient_item' => 'Minyak Fennel, Minyak Ginger, Minyak Kelapa',
                'netweight_item' => '10ml',
                'contain_item' => '1 botol minyak bayi',
                'costprice_item' => 500000,
                'sell_price' => 599000,
                'stock' => 5,
                'unit_item' => 'botol'
            ],
            [
                'category_id' => $categoryIds['Gentle Baby'],
                'name_item' => 'Gentle Baby Tummy Calm',
                'description_item' => 'Minyak bayi untuk meredakan kolik dan perut kembung',
                'ingredient_item' => 'Minyak Fennel, Minyak Peppermint, Minyak Kelapa',
                'netweight_item' => '10ml',
                'contain_item' => '1 botol minyak bayi',
                'costprice_item' => 180000,
                'sell_price' => 220000,
                'stock' => 12,
                'unit_item' => 'botol'
            ],
            [
                'category_id' => $categoryIds['Gentle Baby'],
                'name_item' => 'Gentle Baby Joy',
                'description_item' => 'Minyak bayi dengan aroma menenangkan untuk membantu atasi bayi rewel',
                'ingredient_item' => 'Minyak Rose, Minyak Jasmine, Minyak Kelapa',
                'netweight_item' => '10ml',
                'contain_item' => '1 botol minyak bayi',
                'costprice_item' => 150000,
                'sell_price' => 189000,
                'stock' => 12,
                'unit_item' => 'botol'
            ],
            [
                'category_id' => $categoryIds['Gentle Baby'],
                'name_item' => 'Gentle Baby Immboost',
                'description_item' => 'Minyak bayi untuk meningkatkan daya tahan tubuh dan kesehatan si kecil',
                'ingredient_item' => 'Minyak Orange, Minyak Lemon, Minyak Kelapa',
                'netweight_item' => '10ml',
                'contain_item' => '1 botol minyak bayi',
                'costprice_item' => 70000,
                'sell_price' => 89000,
                'stock' => 18,
                'unit_item' => 'botol'
            ],
            [
                'category_id' => $categoryIds['Gentle Baby'],
                'name_item' => 'Twin Pack NewBorn Essential',
                'description_item' => 'Paket twin pack untuk bayi baru lahir berisi 2 minyak esensial dengan formula khusus untuk bayi 0-6 bulan',
                'ingredient_item' => 'Minyak Lavender, Minyak Chamomile, Minyak Kelapa Murni, Vitamin E',
                'netweight_item' => '2 x 30ml',
                'contain_item' => '2 botol minyak bayi dalam kemasan twin pack',
                'costprice_item' => 120000,
                'sell_price' => 159000,
                'stock' => 15,
                'unit_item' => 'set'
            ],            
            [
                'category_id' => $categoryIds['Gentle Baby'],
                'name_item' => 'Twin Pack Common Cold Relief',
                'description_item' => 'Paket twin pack untuk meredakan batuk pilek berisi 2 minyak dengan formula anti flu dan pereda batuk',
                'ingredient_item' => 'Minyak Eucalyptus, Minyak Tea Tree, Minyak Peppermint, Minyak Kelapa',
                'netweight_item' => '2 x 30ml',
                'contain_item' => '2 botol minyak bayi dalam kemasan twin pack',
                'costprice_item' => 140000,
                'sell_price' => 179000,
                'stock' => 12,
                'unit_item' => 'set'
            ],
            [
                'category_id' => $categoryIds['Gentle Baby'],
                'name_item' => 'Twin Pack Travel Essential',
                'description_item' => 'Paket twin pack untuk traveling berisi 2 minyak portable dengan formula anti nyamuk dan penenang',
                'ingredient_item' => 'Minyak Citronella, Minyak Lavender, Minyak Lemongrass, Minyak Kelapa',
                'netweight_item' => '2 x 30ml',
                'contain_item' => '2 botol minyak bayi dalam kemasan twin pack',
                'costprice_item' => 110000,
                'sell_price' => 149000,
                'stock' => 20,
                'unit_item' => 'set'
            ],
        ];

        foreach ($items as $item) {
            MasterItem::create($item);
        }
    }
}
