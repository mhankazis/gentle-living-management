<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class TransactionSales extends Model
{
    protected $primaryKey = 'transaction_id';
    
    protected $fillable = [
        'transaction_number',
        'user_id',
        'customer_name',
        'customer_email',
        'customer_phone',
        'shipping_address',
        'city',
        'postal_code',
        'notes',
        'subtotal_amount',
        'shipping_cost',
        'tax_amount',
        'total_amount',
        'paid_amount',
        'payment_status',
        'order_status',
        'transaction_date',
        'cancellation_reason',
        'cancellation_requested_at',
        'cancelled_at',
        'cancelled_by'
    ];

    protected $casts = [
        'subtotal_amount' => 'decimal:2',
        'shipping_cost' => 'decimal:2',
        'tax_amount' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'transaction_date' => 'datetime',
        'cancellation_requested_at' => 'datetime',
        'cancelled_at' => 'datetime'
    ];

    // Relationship dengan user
    public function user(): BelongsTo
    {
        return $this->belongsTo(MasterUser::class, 'user_id', 'user_id');
    }

    // Relationship dengan detail transaksi
    public function details(): HasMany
    {
        return $this->hasMany(TransactionSalesDetail::class, 'transaction_id', 'transaction_id');
    }

    // Generate transaction number
    public static function generateTransactionNumber(): string
    {
        $date = now()->format('Ymd');
        $lastTransaction = self::whereDate('created_at', today())
            ->orderBy('transaction_id', 'desc')
            ->first();
        
        $sequence = $lastTransaction ? 
            (int) substr($lastTransaction->transaction_number, -4) + 1 : 1;
        
        return 'TRX' . $date . str_pad($sequence, 4, '0', STR_PAD_LEFT);
    }

    // Scope untuk filter berdasarkan user
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    // Scope untuk filter berdasarkan status pembayaran
    public function scopeByPaymentStatus($query, $status)
    {
        return $query->where('payment_status', $status);
    }

    // Scope untuk filter berdasarkan status pesanan
    public function scopeByOrderStatus($query, $status)
    {
        return $query->where('order_status', $status);
    }

    // Helper method to get payment status
    public function getPaymentStatusLabelAttribute()
    {
        $labels = [
            'pending' => 'Menunggu Pembayaran',
            'paid' => 'Sudah Dibayar',
            'failed' => 'Pembayaran Gagal',
            'refunded' => 'Dikembalikan'
        ];
        
        return $labels[$this->payment_status] ?? 'Unknown';
    }

    // Helper method to get order status
    public function getOrderStatusLabelAttribute()
    {
        $labels = [
            'pending' => 'Menunggu Konfirmasi',
            'confirmed' => 'Dikonfirmasi',
            'processing' => 'Diproses',
            'shipped' => 'Dikirim',
            'delivered' => 'Diterima',
            'cancelled' => 'Dibatalkan',
            'cancellation_requested' => 'Permintaan Pembatalan'
        ];
        
        return $labels[$this->order_status] ?? 'Unknown';
    }

    // Check if transaction can be cancelled
    public function canBeCancelled()
    {
        return in_array($this->order_status, ['pending', 'confirmed', 'processing']) 
               && $this->order_status !== 'cancelled';
    }

    // Check if cancellation can be approved by admin
    public function canApproveCancellation()
    {
        return $this->order_status === 'cancellation_requested';
    }

    // Check if order status can be updated
    public function canUpdateStatus()
    {
        return !in_array($this->order_status, ['cancelled', 'delivered']) 
               && $this->order_status !== 'cancellation_requested';
    }

    // Helper method to get status badge color
    public function getStatusBadgeColorAttribute()
    {
        $colors = [
            'pending' => 'bg-yellow-100 text-yellow-800',
            'confirmed' => 'bg-blue-100 text-blue-800',
            'processing' => 'bg-purple-100 text-purple-800',
            'shipped' => 'bg-indigo-100 text-indigo-800',
            'delivered' => 'bg-green-100 text-green-800',
            'cancelled' => 'bg-red-100 text-red-800',
            'cancellation_requested' => 'bg-orange-100 text-orange-800'
        ];
        
        return $colors[$this->order_status] ?? 'bg-gray-100 text-gray-800';
    }

    // Helper method untuk backward compatibility
    public function getStatusAttribute()
    {
        return $this->order_status;
    }

    // Helper method untuk compatibility dengan HistoryController
    public function getTransactionCodeAttribute()
    {
        return $this->transaction_number;
    }

    public function getTransactionDateAttribute()
    {
        return $this->transaction_date;
    }

    public function getFinalAmountAttribute()
    {
        return $this->total_amount;
    }
}
