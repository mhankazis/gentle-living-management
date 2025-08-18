<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $table = 'order_items';
    protected $primaryKey = 'order_item_id';
    
    protected $fillable = [
        'order_id',
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
    
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id', 'order_id');
    }
    
    public function masterItem()
    {
        return $this->belongsTo(MasterItem::class, 'item_id', 'item_id');
    }
}
