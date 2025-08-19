<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TransactionSales;
use App\Models\TransactionSalesDetail;
use App\Models\MasterUser;
use App\Models\MasterItem;
use Carbon\Carbon;

class TransactionSalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get user and products
        $users = MasterUser::all();
        $products = MasterItem::all();

        if ($users->count() == 0 || $products->count() == 0) {
            $this->command->error('User atau produk tidak ditemukan. Pastikan sudah ada data user dan produk di database.');
            $this->command->info('Users: ' . $users->count() . ', Products: ' . $products->count());
            return;
        }

        $user = $users->first();
        $this->command->info('Creating transactions for user: ' . $user->email . ' (ID: ' . $user->id . ')');

        // Create 3 sample transactions
        for ($i = 1; $i <= 3; $i++) {
            $transactionDate = Carbon::now()->subDays(rand(1, 15));
            
            // Create transaction with manual ID assignment
            $transactionData = [
                'branch_id' => 1,
                'payment_method_id' => rand(1, 4),
                'user_id' => $user->id,
                'customer_id' => null,
                'sales_type_id' => 1,
                'number' => 'TRX' . $transactionDate->format('Ymd') . str_pad($i, 4, '0', STR_PAD_LEFT),
                'date' => $transactionDate,
                'notes' => 'Transaksi contoh ' . $i,
                'subtotal' => 100000,
                'discount_amount' => $i % 2 ? 10000 : 0,
                'discount_percentage' => 0,
                'total_amount' => $i % 2 ? 90000 : 100000,
                'paid_amount' => $i == 1 ? 0 : ($i % 2 ? 90000 : 100000), // First transaction is pending
                'change_amount' => 0,
                'whatsapp' => null,
                'created_at' => $transactionDate,
                'updated_at' => $transactionDate,
            ];

            try {
                $transaction = TransactionSales::create($transactionData);
                $this->command->info('Created transaction: ' . $transaction->number);
                
                // Create sample detail
                if ($products->count() > 0) {
                    $product = $products->first();
                    TransactionSalesDetail::create([
                        'transaction_sales_id' => $transaction->transaction_sales_id,
                        'product_id' => $product->id,
                        'product_name' => $product->name,
                        'product_price' => $product->price,
                        'quantity' => 1,
                        'subtotal' => $product->price,
                        'notes' => 'Detail produk ' . $i,
                    ]);
                }
                
            } catch (\Exception $e) {
                $this->command->error('Error creating transaction ' . $i . ': ' . $e->getMessage());
            }
        }

        $this->command->info('TransactionSales seeder completed!');
    }
}
