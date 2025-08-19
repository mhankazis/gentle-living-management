<?php

require 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

echo "Testing Product Filtering System" . PHP_EOL;
echo "================================" . PHP_EOL . PHP_EOL;

// Test 1: Check categories
echo "1. Testing Categories:" . PHP_EOL;
try {
    $categories = App\Models\MasterCategory::withCount('items')->get();
    if ($categories->count() > 0) {
        echo "✓ Found " . $categories->count() . " categories:" . PHP_EOL;
        foreach ($categories as $category) {
            echo "  - " . $category->name_category . " (ID: " . $category->category_id . ") - " . $category->items_count . " items" . PHP_EOL;
        }
    } else {
        echo "✗ No categories found" . PHP_EOL;
    }
} catch (Exception $e) {
    echo "✗ Error getting categories: " . $e->getMessage() . PHP_EOL;
}

echo PHP_EOL;

// Test 2: Check products
echo "2. Testing Products:" . PHP_EOL;
try {
    $products = App\Models\MasterItem::with('category')->where('stock', '>', 0)->take(5)->get();
    if ($products->count() > 0) {
        echo "✓ Found " . $products->count() . " products (showing first 5):" . PHP_EOL;
        foreach ($products as $product) {
            echo "  - " . $product->name_item . " (Price: Rp" . number_format($product->sell_price, 0, ',', '.') . ", Category: " . ($product->category ? $product->category->name_category : 'No Category') . ")" . PHP_EOL;
        }
    } else {
        echo "✗ No products found" . PHP_EOL;
    }
} catch (Exception $e) {
    echo "✗ Error getting products: " . $e->getMessage() . PHP_EOL;
}

echo PHP_EOL;

// Test 3: Check price range
echo "3. Testing Price Range:" . PHP_EOL;
try {
    $priceRange = App\Models\MasterItem::selectRaw('MIN(sell_price) as min_price, MAX(sell_price) as max_price')->first();
    if ($priceRange) {
        echo "✓ Price range: Rp" . number_format($priceRange->min_price, 0, ',', '.') . " - Rp" . number_format($priceRange->max_price, 0, ',', '.') . PHP_EOL;
    } else {
        echo "✗ Could not get price range" . PHP_EOL;
    }
} catch (Exception $e) {
    echo "✗ Error getting price range: " . $e->getMessage() . PHP_EOL;
}

echo PHP_EOL;

// Test 4: Test filtering functionality
echo "4. Testing Filtering:" . PHP_EOL;
try {
    // Test sort by name
    $sortedProducts = App\Models\MasterItem::where('stock', '>', 0)->orderBy('name_item', 'asc')->take(3)->get();
    echo "✓ Sort by name (first 3): " . PHP_EOL;
    foreach ($sortedProducts as $product) {
        echo "  - " . $product->name_item . PHP_EOL;
    }
    
    // Test sort by price
    $sortedByPrice = App\Models\MasterItem::where('stock', '>', 0)->orderBy('sell_price', 'asc')->take(3)->get();
    echo "✓ Sort by price low to high (first 3): " . PHP_EOL;
    foreach ($sortedByPrice as $product) {
        echo "  - " . $product->name_item . " (Rp" . number_format($product->sell_price, 0, ',', '.') . ")" . PHP_EOL;
    }
} catch (Exception $e) {
    echo "✗ Error testing filtering: " . $e->getMessage() . PHP_EOL;
}

echo PHP_EOL . "Testing complete!" . PHP_EOL;
