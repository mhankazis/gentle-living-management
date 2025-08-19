<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TransactionSalesDetail extends Model
{
    protected $primaryKey = 'transaction_sales_detail_id';
    
    protected $fillable = [
        'transaction_sales_id',
        'product_id',
        'product_name',
        'product_price',
        'quantity',
        'subtotal',
        'notes'
    ];

    protected $casts = [
        'product_price' => 'decimal:2',
        'subtotal' => 'decimal:2'
    ];

    // Relationship dengan transaction sales
    public function transaction(): BelongsTo
    {
        return $this->belongsTo(TransactionSales::class, 'transaction_sales_id', 'transaction_sales_id');
    }

    // Relationship dengan produk
    public function product(): BelongsTo
    {
        return $this->belongsTo(MasterItem::class, 'product_id');
    }
}
