<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $table = 'carts';
    protected $primaryKey = 'cart_id';
    
    protected $fillable = [
        'session_id',
        'item_id',
        'item_name',
        'item_price',
        'quantity',
        'subtotal'
    ];
    
    protected $casts = [
        'item_price' => 'decimal:2',
        'subtotal' => 'decimal:2',
        'quantity' => 'integer'
    ];
    
    public function masterItem()
    {
        return $this->belongsTo(MasterItem::class, 'item_id', 'item_id');
    }
    
    public static function getCartItems($sessionId)
    {
        return self::where('session_id', $sessionId)->with('masterItem')->get();
    }
    
    public static function getTotalAmount($sessionId)
    {
        return self::where('session_id', $sessionId)->sum('subtotal');
    }
    
    public static function getTotalItems($sessionId)
    {
        return self::where('session_id', $sessionId)->sum('quantity');
    }
}
