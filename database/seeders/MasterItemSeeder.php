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

        // Create categories first
        $categories = [
            ['name_category' => 'Minyak Bayi'],
            ['name_category' => 'Aromaterapi'],
            ['name_category' => 'Kesehatan'],
            ['name_category' => 'Perawatan Kulit'],
            ['name_category' => 'Essential Oil'],
        ];

        foreach ($categories as $category) {
            MasterCategory::create($category);
        }

        // Create items
        $items = [
            // Minyak Bayi
            [
                'category_id' => 1,
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
                'category_id' => 1,
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
                'category_id' => 1,
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
                'category_id' => 1,
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
                'category_id' => 1,
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
                'category_id' => 2,
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
            [
                'category_id' => 2,
                'name_item' => 'Relaxing Lavender Blend',
                'description_item' => 'Campuran minyak lavender untuk relaksasi dan mengurangi stress',
                'ingredient_item' => 'Minyak Lavender, Minyak Bergamot, Minyak Jojoba',
                'netweight_item' => '15ml',
                'contain_item' => '1 botol aromaterapi',
                'costprice_item' => 120000,
                'sell_price' => 150000,
                'stock' => 20,
                'unit_item' => 'botol'
            ],
            [
                'category_id' => 2,
                'name_item' => 'Energizing Citrus Blend',
                'description_item' => 'Campuran minyak citrus untuk meningkatkan energi dan mood',
                'ingredient_item' => 'Minyak Orange, Minyak Lemon, Minyak Grapefruit',
                'netweight_item' => '15ml',
                'contain_item' => '1 botol aromaterapi',
                'costprice_item' => 100000,
                'sell_price' => 125000,
                'stock' => 18,
                'unit_item' => 'botol'
            ],

            // Kesehatan
            [
                'category_id' => 3,
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
            [
                'category_id' => 3,
                'name_item' => 'Immunity Booster Oil',
                'description_item' => 'Minyak untuk meningkatkan sistem kekebalan tubuh',
                'ingredient_item' => 'Minyak Tea Tree, Minyak Eucalyptus, Minyak Carrier',
                'netweight_item' => '20ml',
                'contain_item' => '1 botol minyak kesehatan',
                'costprice_item' => 160000,
                'sell_price' => 195000,
                'stock' => 10,
                'unit_item' => 'botol'
            ],
            [
                'category_id' => 3,
                'name_item' => 'Digestive Support Oil',
                'description_item' => 'Minyak untuk mendukung pencernaan yang sehat',
                'ingredient_item' => 'Minyak Ginger, Minyak Fennel, Minyak Peppermint',
                'netweight_item' => '15ml',
                'contain_item' => '1 botol minyak kesehatan',
                'costprice_item' => 140000,
                'sell_price' => 175000,
                'stock' => 14,
                'unit_item' => 'botol'
            ],

            // Perawatan Kulit
            [
                'category_id' => 4,
                'name_item' => 'Gentle Face Serum',
                'description_item' => 'Serum wajah alami untuk kulit sensitif',
                'ingredient_item' => 'Minyak Rosehip, Minyak Jojoba, Vitamin E',
                'netweight_item' => '30ml',
                'contain_item' => '1 botol serum',
                'costprice_item' => 250000,
                'sell_price' => 320000,
                'stock' => 8,
                'unit_item' => 'botol'
            ],
            [
                'category_id' => 4,
                'name_item' => 'Moisturizing Body Oil',
                'description_item' => 'Minyak tubuh untuk melembabkan kulit kering',
                'ingredient_item' => 'Minyak Argan, Minyak Sweet Almond, Minyak Lavender',
                'netweight_item' => '100ml',
                'contain_item' => '1 botol minyak tubuh',
                'costprice_item' => 180000,
                'sell_price' => 230000,
                'stock' => 15,
                'unit_item' => 'botol'
            ],
            [
                'category_id' => 4,
                'name_item' => 'Anti-Aging Face Oil',
                'description_item' => 'Minyak wajah anti-aging dengan bahan alami',
                'ingredient_item' => 'Minyak Rosehip, Minyak Pomegranate, Minyak Frankincense',
                'netweight_item' => '30ml',
                'contain_item' => '1 botol minyak wajah',
                'costprice_item' => 300000,
                'sell_price' => 380000,
                'stock' => 6,
                'unit_item' => 'botol'
            ],

            // Essential Oil
            [
                'category_id' => 5,
                'name_item' => 'Pure Lavender Essential Oil',
                'description_item' => 'Minyak esensial lavender murni 100%',
                'ingredient_item' => '100% Pure Lavender Essential Oil',
                'netweight_item' => '10ml',
                'contain_item' => '1 botol essential oil',
                'costprice_item' => 80000,
                'sell_price' => 110000,
                'stock' => 25,
                'unit_item' => 'botol'
            ],
            [
                'category_id' => 5,
                'name_item' => 'Pure Tea Tree Essential Oil',
                'description_item' => 'Minyak esensial tea tree murni untuk antiseptik',
                'ingredient_item' => '100% Pure Tea Tree Essential Oil',
                'netweight_item' => '10ml',
                'contain_item' => '1 botol essential oil',
                'costprice_item' => 90000,
                'sell_price' => 125000,
                'stock' => 20,
                'unit_item' => 'botol'
            ],
            [
                'category_id' => 5,
                'name_item' => 'Pure Eucalyptus Essential Oil',
                'description_item' => 'Minyak esensial eucalyptus murni untuk pernapasan',
                'ingredient_item' => '100% Pure Eucalyptus Essential Oil',
                'netweight_item' => '10ml',
                'contain_item' => '1 botol essential oil',
                'costprice_item' => 70000,
                'sell_price' => 95000,
                'stock' => 30,
                'unit_item' => 'botol'
            ],
            [
                'category_id' => 5,
                'name_item' => 'Pure Peppermint Essential Oil',
                'description_item' => 'Minyak esensial peppermint murni untuk kesegaran',
                'ingredient_item' => '100% Pure Peppermint Essential Oil',
                'netweight_item' => '10ml',
                'contain_item' => '1 botol essential oil',
                'costprice_item' => 85000,
                'sell_price' => 115000,
                'stock' => 22,
                'unit_item' => 'botol'
            ],
            [
                'category_id' => 5,
                'name_item' => 'Pure Lemon Essential Oil',
                'description_item' => 'Minyak esensial lemon murni untuk mood booster',
                'ingredient_item' => '100% Pure Lemon Essential Oil',
                'netweight_item' => '10ml',
                'contain_item' => '1 botol essential oil',
                'costprice_item' => 65000,
                'sell_price' => 85000,
                'stock' => 28,
                'unit_item' => 'botol'
            ]
        ];

        foreach ($items as $item) {
            MasterItem::create($item);
        }
    }
}
