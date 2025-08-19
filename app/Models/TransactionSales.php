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
        'subtotal',
        'discount_amount',
        'discount_percentage',
        'total_amount',
        'paid_amount',
        'change_amount',
        'whatsapp'
    ];

    protected $casts = [
        'subtotal' => 'decimal:2',
        'discount_amount' => 'decimal:2',
        'discount_percentage' => 'decimal:2',
        'total_amount' => 'decimal:2',
        'paid_amount' => 'decimal:2',
        'change_amount' => 'decimal:2',
        'date' => 'datetime'
    ];

    // Relationship dengan user
    public function user(): BelongsTo
    {
        return $this->belongsTo(MasterUser::class, 'user_id');
    }

    // Relationship dengan detail transaksi
    public function details(): HasMany
    {
        return $this->hasMany(TransactionSalesDetail::class, 'transaction_sales_id');
    }

    // Generate transaction number
    public static function generateTransactionNumber(): string
    {
        $date = now()->format('Ymd');
        $lastTransaction = self::whereDate('created_at', today())
            ->orderBy('transaction_sales_id', 'desc')
            ->first();
        
        $sequence = $lastTransaction ? 
            (int) substr($lastTransaction->number, -4) + 1 : 1;
        
        return 'TRX' . $date . str_pad($sequence, 4, '0', STR_PAD_LEFT);
    }

    // Scope untuk filter berdasarkan user
    public function scopeForUser($query, $userId)
    {
        return $query->where('user_id', $userId);
    }

    // Scope untuk filter berdasarkan status (based on paid_amount vs total_amount)
    public function scopeByStatus($query, $status)
    {
        switch ($status) {
            case 'pending':
                return $query->where('paid_amount', '<', DB::raw('total_amount'));
            case 'paid':
                return $query->where('paid_amount', '>=', DB::raw('total_amount'));
            default:
                return $query;
        }
    }

    // Helper method to get status
    public function getStatusAttribute()
    {
        if ($this->paid_amount >= $this->total_amount) {
            return 'paid';
        }
        return 'pending';
    }

    // Helper method to get final amount
    public function getFinalAmountAttribute()
    {
        return $this->total_amount;
    }

    // Helper method to get transaction code
    public function getTransactionCodeAttribute()
    {
        return $this->number;
    }

    // Helper method to get transaction date
    public function getTransactionDateAttribute()
    {
        return $this->date;
    }
}
