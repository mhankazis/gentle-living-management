<?php

require __DIR__ . '/vendor/autoload.php';

$app = require_once __DIR__ . '/bootstrap/app.php';
$app->make(\Illuminate\Contracts\Console\Kernel::class)->bootstrap();

use App\Models\MasterCategory;
use App\Models\MasterItem;

echo "Testing data:\n";
echo "Categories: " . MasterCategory::count() . "\n";
echo "Items: " . MasterItem::count() . "\n";

echo "\nSample Category: \n";
$cat = MasterCategory::first();
if ($cat) {
    echo "ID: " . $cat->category_id . "\n";
    echo "Name: " . $cat->name_category . "\n";
}

echo "\nSample Item: \n";
$item = MasterItem::first();
if ($item) {
    echo "ID: " . $item->item_id . "\n";
    echo "Name: " . $item->name_item . "\n";
    echo "Price: " . $item->sell_price . "\n";
    echo "Stock: " . $item->stock . "\n";
}

echo "\nCategories with items:\n";
$categories = MasterCategory::withCount('items')->get();
foreach ($categories as $category) {
    echo "- {$category->name_category}: {$category->items_count} items\n";
}
