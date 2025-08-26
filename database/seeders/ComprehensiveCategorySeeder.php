<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\MasterItem;
use App\Models\MasterCategory;

class ComprehensiveCategorySeeder extends Seeder
{
    public function run()
    {
        // Clear existing data
        DB::table('master_items')->delete();
        DB::table('master_categories')->delete();

        // Create comprehensive categories
        $categoryData = [
            [
                'category_name' => 'Minyak Bayi',
                'description' => 'Koleksi minyak bayi premium untuk perawatan dan kenyamanan si kecil'
            ],
            [
                'category_name' => 'Aromaterapi', 
                'description' => 'Essential oil dan minyak aromaterapi untuk relaksasi dan mood'
            ],
            [
                'category_name' => 'Kesehatan',
                'description' => 'Produk kesehatan alami untuk daya tahan tubuh dan wellness'
            ],
            [
                'category_name' => 'Perawatan Kulit',
                'description' => 'Produk perawatan kulit alami untuk seluruh keluarga'
            ],
            [
                'category_name' => 'Essential Oil',
                'description' => 'Essential oil murni berkualitas tinggi untuk berbagai kebutuhan'
            ]
        ];

        $categoryIds = [];
        foreach ($categoryData as $categoryInfo) {
            $category = MasterCategory::create($categoryInfo);
            $categoryIds[$categoryInfo['category_name']] = $category->category_id;
        }

        // Create comprehensive product items
        $items = [
            // Minyak Bayi
            [
                'category_id' => $categoryIds['Minyak Bayi'],
                'name_item' => 'Gentle Baby Deep Sleep',
                'description_item' => 'Minyak bayi untuk membantu bayi tidur nyenyak dengan aroma lavender dan chamomile yang menenangkan',
                'ingredient_item' => 'Minyak Lavender, Minyak Chamomile, Minyak Sunflower Seed',
                'netweight_item' => '100ml',
                'contain_item' => '1 botol minyak bayi',
                'costprice_item' => 200000,
                'sell_price' => 249000,
                'stock' => 8,
                'unit_item' => 'botol'
            ],
            [
                'category_id' => $categoryIds['Minyak Bayi'],
                'name_item' => 'Gentle Baby Bye Bugs',
                'description_item' => 'Minyak bayi yang mengusir nyamuk dan serangga dengan aman menggunakan bahan alami',
                'ingredient_item' => 'Minyak Citronella, Minyak Lemongrass, Minyak Sunflower Seed',
                'netweight_item' => '100ml',
                'contain_item' => '1 botol minyak bayi',
                'costprice_item' => 40000,
                'sell_price' => 49000,
                'stock' => 25,
                'unit_item' => 'botol'
            ],
            [
                'category_id' => $categoryIds['Minyak Bayi'],
                'name_item' => 'Gentle Baby LDR Booster',
                'description_item' => 'Minyak bayi dengan formula khusus untuk memperlancar ASI ibu menyusui',
                'ingredient_item' => 'Minyak Fennel, Minyak Ginger, Minyak Sunflower Seed',
                'netweight_item' => '100ml',
                'contain_item' => '1 botol minyak bayi',
                'costprice_item' => 500000,
                'sell_price' => 599000,
                'stock' => 5,
                'unit_item' => 'botol'
            ],
            [
                'category_id' => $categoryIds['Minyak Bayi'],
                'name_item' => 'Gentle Baby Tummy Calm',
                'description_item' => 'Minyak bayi untuk meredakan kolik dan perut kembung pada bayi',
                'ingredient_item' => 'Minyak Fennel, Minyak Peppermint, Minyak Sunflower Seed',
                'netweight_item' => '100ml',
                'contain_item' => '1 botol minyak bayi',
                'costprice_item' => 180000,
                'sell_price' => 220000,
                'stock' => 12,
                'unit_item' => 'botol'
            ],

            // Aromaterapi
            [
                'category_id' => $categoryIds['Aromaterapi'],
                'name_item' => 'Deep Sleep Essential Oil',
                'description_item' => 'Lavender & Chamomile blend untuk tidur nyenyak dan relaksasi mendalam',
                'ingredient_item' => 'Pure Lavender Oil, Chamomile Oil, Sweet Orange Oil',
                'netweight_item' => '100ml',
                'contain_item' => '1 botol essential oil',
                'costprice_item' => 70000,
                'sell_price' => 89000,
                'stock' => 15,
                'unit_item' => 'botol'
            ],
            [
                'category_id' => $categoryIds['Aromaterapi'],
                'name_item' => 'Calming & Focus Oil',
                'description_item' => 'Peppermint & Eucalyptus untuk konsentrasi optimal dan menenangkan pikiran',
                'ingredient_item' => 'Peppermint Oil, Eucalyptus Oil, Rosemary Oil',
                'netweight_item' => '100ml',
                'contain_item' => '1 botol essential oil',
                'costprice_item' => 75000,
                'sell_price' => 95000,
                'stock' => 20,
                'unit_item' => 'botol'
            ],
            [
                'category_id' => $categoryIds['Aromaterapi'],
                'name_item' => 'Joy & Happiness Oil',
                'description_item' => 'Citrus blend untuk mood positif sepanjang hari dan energi yang menyegarkan',
                'ingredient_item' => 'Sweet Orange Oil, Lemon Oil, Bergamot Oil',
                'netweight_item' => '100ml',
                'contain_item' => '1 botol essential oil',
                'costprice_item' => 68000,
                'sell_price' => 88000,
                'stock' => 18,
                'unit_item' => 'botol'
            ],

            // Kesehatan
            [
                'category_id' => $categoryIds['Kesehatan'],
                'name_item' => 'Immune Booster Oil',
                'description_item' => 'Tea Tree & Oregano untuk meningkatkan daya tahan tubuh secara alami',
                'ingredient_item' => 'Tea Tree Oil, Oregano Oil, Thyme Oil',
                'netweight_item' => '100ml',
                'contain_item' => '1 botol essential oil',
                'costprice_item' => 72000,
                'sell_price' => 92000,
                'stock' => 14,
                'unit_item' => 'botol'
            ],
            [
                'category_id' => $categoryIds['Kesehatan'],
                'name_item' => 'Cough & Flu Relief',
                'description_item' => 'Minyak herbal untuk membantu meredakan batuk dan flu secara alami',
                'ingredient_item' => 'Eucalyptus Oil, Pine Oil, Peppermint Oil',
                'netweight_item' => '100ml',
                'contain_item' => '1 botol minyak herbal',
                'costprice_item' => 85000,
                'sell_price' => 110000,
                'stock' => 10,
                'unit_item' => 'botol'
            ],

            // Perawatan Kulit
            [
                'category_id' => $categoryIds['Perawatan Kulit'],
                'name_item' => 'Natural Skin Care Oil',
                'description_item' => 'Minyak perawatan kulit alami untuk melembabkan dan menutrisi kulit',
                'ingredient_item' => 'Jojoba Oil, Argan Oil, Vitamin E',
                'netweight_item' => '50ml',
                'contain_item' => '1 botol minyak perawatan',
                'costprice_item' => 120000,
                'sell_price' => 150000,
                'stock' => 8,
                'unit_item' => 'botol'
            ],

            // Essential Oil
            [
                'category_id' => $categoryIds['Essential Oil'],
                'name_item' => 'Pure Lavender Essential Oil',
                'description_item' => 'Essential oil lavender murni 100% untuk aromaterapi dan relaksasi',
                'ingredient_item' => '100% Pure Lavender Essential Oil',
                'netweight_item' => '30ml',
                'contain_item' => '1 botol essential oil',
                'costprice_item' => 45000,
                'sell_price' => 65000,
                'stock' => 25,
                'unit_item' => 'botol'
            ],
            [
                'category_id' => $categoryIds['Essential Oil'],
                'name_item' => 'Pure Tea Tree Essential Oil',
                'description_item' => 'Essential oil tea tree murni untuk antiseptik dan perawatan kulit',
                'ingredient_item' => '100% Pure Tea Tree Essential Oil',
                'netweight_item' => '30ml',
                'contain_item' => '1 botol essential oil',
                'costprice_item' => 55000,
                'sell_price' => 75000,
                'stock' => 20,
                'unit_item' => 'botol'
            ]
        ];

        foreach ($items as $item) {
            MasterItem::create($item);
        }

        echo "✅ Comprehensive categories and products seeded successfully!\n";
        echo "📊 Created " . count($categoryData) . " categories\n";
        echo "🛍️ Created " . count($items) . " products\n";
    }
}
