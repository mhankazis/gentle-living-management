<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\DB;

class TransactionSales extends Model
{
    protected $primaryKey = 'transaction_sales_id';
    
    protected $fillable = [
        'branch_id',
        'payment_method_id',
        'user_id',
        'customer_id',
        'sales_type_id',
        'number',
        'date',
        'notes',
        'admin_notes',
        'payment_notes',
        'updated_by',
        'payment_updated_by',
        'status_updated_at',
        'payment_updated_at',
        'subtotal',
        'discount_amount',
        'discount_percentage',
        'total_amount',
        'paid_amount',
        'change_amount',
        'whatsapp',
        'status',
        'payment_status',
        'customer_name',
        'customer_phone',
        'customer_address',
        'cancellation_requested_at'
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
        return $this->hasMany(TransactionSalesDetail::class, 'transaction_sales_id', 'transaction_sales_id');
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
