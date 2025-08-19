<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'order_id';
    
    protected $fillable = [
        'order_number',
        'customer_name',
        'customer_email', 
        'customer_phone',
        'shipping_address',
        'city',
        'postal_code',
        'subtotal',
        'shipping_cost',
        'total',
        'status',
        'payment_status',
        'cancellation_reason',
        'cancellation_requested_at',
        'cancelled_at',
        'admin_notes'
    ];
    
    protected $casts = [
        'subtotal' => 'decimal:2',
        'shipping_cost' => 'decimal:2',
        'total' => 'decimal:2',
        'cancellation_requested_at' => 'datetime',
        'cancelled_at' => 'datetime'
    ];
    
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
    }
    
    public function canBeCancelled()
    {
        // User dapat request cancellation jika status belum shipped/delivered
        return !in_array($this->status, ['shipped', 'delivered', 'cancelled']);
    }

    public function canBeDirectlyCancelled()
    {
        // Admin dapat langsung cancel jika belum shipped/delivered
        return !in_array($this->status, ['shipped', 'delivered', 'cancelled']);
    }

    public function hasPendingCancellation()
    {
        return !is_null($this->cancellation_requested_at) && is_null($this->cancelled_at);
    }

    public function masterCustomer()
    {
        return $this->belongsTo(MasterCustomer::class, 'customer_email', 'email');
    }
    
    public function getStatusLabelAttribute()
    {
        $labels = [
            'pending' => 'Menunggu Konfirmasi',
            'confirmed' => 'Dikonfirmasi',
            'processing' => 'Diproses',
            'shipped' => 'Dikirim',
            'delivered' => 'Diterima',
            'cancelled' => 'Dibatalkan'
        ];
        
        return $labels[$this->status] ?? $this->status;
    }
}
