<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterItem;
use App\Models\MasterCategory;
use Illuminate\Support\Facades\Log;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        return $this->getProducts($request);
    }
    
    protected function getProducts(Request $request, $categoryId = null)
    {
        $query = MasterItem::with('category')->where('stock', '>', 0);
        
        // Filter by specific category if provided
        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }
        
        // Filter by category from request
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
                case 'name':
                    $query->orderBy('name_item', 'asc');
                    break;
                case 'price_low':
                    $query->orderBy('sell_price', 'asc');
                    break;
                case 'price_high':
                    $query->orderBy('sell_price', 'desc');
                    break;
                case 'rating':
                    // For now, sort by name since we don't have rating field
                    $query->orderBy('name_item', 'asc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                default:
                    $query->orderBy('name_item', 'asc');
                    break;
            }
        } else {
            $query->orderBy('name_item', 'asc');
        }
        
        $products = $query->paginate(9);
        $categories = MasterCategory::withCount('items')->get();
        
        // Get min and max prices for price range filter
        $priceRange = MasterItem::selectRaw('MIN(sell_price) as min_price, MAX(sell_price) as max_price')->first();
        
        // Get current category if categoryId is provided
        $category = $categoryId ? MasterCategory::findOrFail($categoryId) : null;
        
        return view('products.index', compact('products', 'categories', 'priceRange', 'category'));
    }
    
    public function show($id)
    {
        try {
            $product = MasterItem::with('category')->findOrFail($id);
            
            // Get related products based on category, excluding current product
            $relatedProducts = MasterItem::with('category')
                ->where('category_id', $product->category_id)
                ->where('item_id', '!=', $id)
                ->where('stock', '>', 0)
                ->limit(4)
                ->get();
            
            // Add image_url attribute if needed
            $product->image_url = $product->image_url ?? asset('images/placeholder.jpg');
            
            foreach ($relatedProducts as $relatedProduct) {
                $relatedProduct->image_url = $relatedProduct->image_url ?? asset('images/placeholder.jpg');
            }
            
            return view('product-detail', compact('product', 'relatedProducts'));
        } catch (\Exception $e) {
            Log::error('Product detail error: ' . $e->getMessage());
            return redirect()->route('products.index')->with('error', 'Produk tidak ditemukan.');
        }
    }
    
    public function getByCategory(Request $request, $categoryId)
    {
        return $this->getProducts($request, $categoryId);
    }
}
