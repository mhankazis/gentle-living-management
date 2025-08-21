<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MasterItem extends Model
{
    use SoftDeletes;
    
    protected $table = 'master_items';
    protected $primaryKey = 'item_id';
    
    protected $fillable = [
        'category_id',
        'name_item',
        'description_item',
        'ingredient_item',
        'netweight_item',
        'contain_item',
        'costprice_item',
        'sell_price',
        'stock',
        'unit_item',
        'image'
    ];
    
    protected $casts = [
        'costprice_item' => 'decimal:2',
        'sell_price' => 'decimal:2',
        'stock' => 'integer',
        'category_id' => 'integer'
    ];
    
    // Accessor for image URL
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('images/' . $this->image);
        }
        return asset('images/placeholder.jpg');
    }
    
    // Relationship with category if needed
    public function category()
    {
        return $this->belongsTo(MasterCategory::class, 'category_id', 'category_id');
    }
}
