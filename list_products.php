<?php

require_once 'vendor/autoload.php';

use App\Models\MasterItem;

// Load Laravel app
$app = require_once 'bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

echo "Current Products:\n";
echo "================\n";

$products = MasterItem::all();

foreach ($products as $product) {
    echo "{$product->item_id}: {$product->name_item}\n";
}

echo "\nTotal products: " . $products->count() . "\n";
