<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterItem;
use App\Models\MasterCategory;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = MasterItem::with('category')->where('stock', '>', 0);
        
        // Filter by category
        if ($request->has('category') && $request->category != '') {
            $query->where('category_id', $request->category);
        }
        
        // Filter by price range
        if ($request->has('min_price') && $request->min_price != '') {
            $query->where('sell_price', '>=', $request->min_price);
        }
        
        if ($request->has('max_price') && $request->max_price != '') {
            $query->where('sell_price', '<=', $request->max_price);
        }
        
        // Search by name
        if ($request->has('search') && $request->search != '') {
            $query->where('name_item', 'like', '%' . $request->search . '%');
        }
        
        // Sorting
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'name_asc':
                    $query->orderBy('name_item', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name_item', 'desc');
                    break;
                case 'price_asc':
                    $query->orderBy('sell_price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('sell_price', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                default:
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        } else {
            $query->orderBy('created_at', 'desc');
        }
        
        $products = $query->paginate(9);
        $categories = MasterCategory::withCount('items')->get();
        
        // Get min and max prices for price range filter
        $priceRange = MasterItem::selectRaw('MIN(sell_price) as min_price, MAX(sell_price) as max_price')->first();
        
        return view('products.index', compact('products', 'categories', 'priceRange'));
    }
    
    public function show($id)
    {
        $product = MasterItem::with('category')->findOrFail($id);
        $relatedProducts = MasterItem::where('category_id', $product->category_id)
            ->where('item_id', '!=', $id)
            ->where('stock', '>', 0)
            ->limit(4)
            ->get();
            
        return view('product-detail', compact('product', 'relatedProducts'));
    }
    
    public function getByCategory($categoryId)
    {
        $products = MasterItem::where('category_id', $categoryId)
            ->where('stock', '>', 0)
            ->paginate(12);
            
        $category = MasterCategory::findOrFail($categoryId);
        $categories = MasterCategory::has('items')->get();
        
        return view('products.index', compact('products', 'categories', 'category'));
    }
}
