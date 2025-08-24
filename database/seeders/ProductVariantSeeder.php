<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MasterCategory;
use App\Models\MasterItem;

class ProductVariantSeeder extends Seeder
{
    /**
     * Run the database seeder.
     */
    public function run(): void
    {
        // Create Therapeutic Oils category
        $therapeuticCategory = MasterCategory::firstOrCreate([
            'name_category' => 'Therapeutic Oils'
        ]);

        // Create Baby Care category
        $babyCareCategory = MasterCategory::firstOrCreate([
            'name_category' => 'Baby Care'
        ]);

        // Create TopCare category
        $topCareCategory = MasterCategory::firstOrCreate([
            'name_category' => 'TopCare Products'
        ]);

        // Sample Therapeutic Oils products
        $therapeuticProducts = [
            [
                'name_item' => 'Deep Sleep Essential Oil',
                'description_item' => 'Essential oil blend dengan lavender dan chamomile untuk tidur nyenyak dan relaksasi mendalam. Membantu menenangkan pikiran dan mempersiapkan tubuh untuk istirahat yang berkualitas.',
                'ingredient_item' => 'Lavender Oil, Chamomile Oil, Sweet Orange Oil, Bergamot Oil',
                'netweight_item' => '100ml',
                'contain_item' => '100% Pure Essential Oil Blend',
                'costprice_item' => 65000,
                'sell_price' => 89000,
                'stock' => 25,
                'unit_item' => 'Bottle',
            ],
            [
                'name_item' => 'Calming & Focus Essential Oil',
                'description_item' => 'Perpaduan peppermint dan eucalyptus untuk meningkatkan fokus dan konsentrasi. Ideal untuk produktivitas dan mengurangi stress mental.',
                'ingredient_item' => 'Peppermint Oil, Eucalyptus Oil, Rosemary Oil, Lemon Oil',
                'netweight_item' => '100ml',
                'contain_item' => '100% Pure Essential Oil Blend',
                'costprice_item' => 70000,
                'sell_price' => 95000,
                'stock' => 18,
                'unit_item' => 'Bottle',
            ],
            [
                'name_item' => 'Joy & Happiness Essential Oil',
                'description_item' => 'Citrus blend yang menyegarkan untuk meningkatkan mood dan energi positif. Memberikan perasaan bahagia dan optimis sepanjang hari.',
                'ingredient_item' => 'Sweet Orange Oil, Lemon Oil, Grapefruit Oil, Ylang Ylang Oil',
                'netweight_item' => '100ml',
                'contain_item' => '100% Pure Essential Oil Blend',
                'costprice_item' => 62000,
                'sell_price' => 88000,
                'stock' => 30,
                'unit_item' => 'Bottle',
            ],
            [
                'name_item' => 'Immune Booster Essential Oil',
                'description_item' => 'Kombinasi tea tree dan oregano untuk meningkatkan daya tahan tubuh. Membantu melindungi dari infeksi dan memperkuat sistem imun.',
                'ingredient_item' => 'Tea Tree Oil, Oregano Oil, Thyme Oil, Clove Oil',
                'netweight_item' => '100ml',
                'contain_item' => '100% Pure Essential Oil Blend',
                'costprice_item' => 68000,
                'sell_price' => 92000,
                'stock' => 22,
                'unit_item' => 'Bottle',
            ],
            [
                'name_item' => 'Good Feeling Essential Oil',
                'description_item' => 'Aromaterapi untuk menciptakan suasana hati yang baik dan mengurangi kecemasan. Memberikan rasa tenang dan kebahagiaan.',
                'ingredient_item' => 'Geranium Oil, Rose Oil, Sandalwood Oil, Frankincense Oil',
                'netweight_item' => '100ml',
                'contain_item' => '100% Pure Essential Oil Blend',
                'costprice_item' => 75000,
                'sell_price' => 98000,
                'stock' => 15,
                'unit_item' => 'Bottle',
            ],
            [
                'name_item' => 'Love & Dream Essential Oil',
                'description_item' => 'Blend romantis untuk menciptakan suasana hangat dan mimpi indah. Cocok untuk relaksasi bersama pasangan.',
                'ingredient_item' => 'Rose Oil, Jasmine Oil, Patchouli Oil, Vanilla Oil',
                'netweight_item' => '100ml',
                'contain_item' => '100% Pure Essential Oil Blend',
                'costprice_item' => 72000,
                'sell_price' => 96000,
                'stock' => 20,
                'unit_item' => 'Bottle',
            ],
            [
                'name_item' => 'Total Care Essential Oil',
                'description_item' => 'Essential oil serbaguna untuk perawatan menyeluruh. Kombinasi berbagai minyak terbaik untuk kesehatan optimal.',
                'ingredient_item' => 'Lavender Oil, Tea Tree Oil, Eucalyptus Oil, Lemon Oil',
                'netweight_item' => '100ml',
                'contain_item' => '100% Pure Essential Oil Blend',
                'costprice_item' => 70000,
                'sell_price' => 94000,
                'stock' => 28,
                'unit_item' => 'Bottle',
            ]
        ];

        // Sample Baby Care products
        $babyCareProducts = [
            [
                'name_item' => 'Gentle Baby Oil',
                'description_item' => 'Minyak bayi aromaterapi dengan kombinasi essential oil dan sunflower seed oil untuk kesehatan ibu, bayi dan balita. Aman untuk bayi baru lahir.',
                'ingredient_item' => 'Sunflower Seed Oil, Chamomile Oil, Lavender Oil, Calendula Extract',
                'netweight_item' => '100ml',
                'contain_item' => 'Baby Safe Essential Oil Blend',
                'costprice_item' => 55000,
                'sell_price' => 78000,
                'stock' => 35,
                'unit_item' => 'Bottle',
            ],
            [
                'name_item' => 'Massage Your Baby Oil',
                'description_item' => 'Minyak pijat khusus bayi dengan formula lembut dan aman. Membantu meningkatkan ikatan emosional dan perkembangan bayi.',
                'ingredient_item' => 'Sweet Almond Oil, Jojoba Oil, Chamomile Oil, Vitamin E',
                'netweight_item' => '100ml',
                'contain_item' => 'Baby Massage Oil Blend',
                'costprice_item' => 58000,
                'sell_price' => 82000,
                'stock' => 25,
                'unit_item' => 'Bottle',
            ]
        ];

        // Sample TopCare products
        $topCareProducts = [
            [
                'name_item' => 'TopCare Complete Care',
                'description_item' => 'Perawatan komprehensif untuk kebutuhan sehari-hari. Produk multifungsi dengan kualitas premium.',
                'ingredient_item' => 'Natural Extract, Vitamin Complex, Mineral Blend',
                'netweight_item' => '150ml',
                'contain_item' => 'Complete Care Formula',
                'costprice_item' => 80000,
                'sell_price' => 120000,
                'stock' => 15,
                'unit_item' => 'Bottle',
            ],
            [
                'name_item' => 'TopCare Natural Boost',
                'description_item' => 'Booster alami untuk meningkatkan vitalitas dan kesehatan. Formula khusus dengan bahan-bahan terpilih.',
                'ingredient_item' => 'Ginseng Extract, Royal Jelly, Honey, Herbal Blend',
                'netweight_item' => '120ml',
                'contain_item' => 'Natural Booster Formula',
                'costprice_item' => 85000,
                'sell_price' => 125000,
                'stock' => 12,
                'unit_item' => 'Bottle',
            ],
            [
                'name_item' => 'TopCare Total Vitality',
                'description_item' => 'Suplemen untuk vitalitas total dengan kombinasi vitamin dan mineral esensial. Mendukung kesehatan optimal.',
                'ingredient_item' => 'Multivitamin, Mineral Complex, Antioxidant Blend',
                'netweight_item' => '100ml',
                'contain_item' => 'Vitality Support Formula',
                'costprice_item' => 75000,
                'sell_price' => 115000,
                'stock' => 18,
                'unit_item' => 'Bottle',
            ]
        ];

        // Insert Therapeutic Oils
        foreach ($therapeuticProducts as $product) {
            $product['category_id'] = $therapeuticCategory->category_id;
            MasterItem::create($product);
        }

        // Insert Baby Care products
        foreach ($babyCareProducts as $product) {
            $product['category_id'] = $babyCareCategory->category_id;
            MasterItem::create($product);
        }

        // Insert TopCare products
        foreach ($topCareProducts as $product) {
            $product['category_id'] = $topCareCategory->category_id;
            MasterItem::create($product);
        }
    }
}
