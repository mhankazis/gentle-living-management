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
        $this->command->info('Creating transactions for user: ' . $user->email . ' (ID: ' . $user->user_id . ')');

        // Create 3 sample transactions
        for ($i = 1; $i <= 3; $i++) {
            $transactionDate = Carbon::now()->subDays(rand(1, 15));
            $totalAmount = 100000 + ($i * 25000); // Vary amounts
            $discountAmount = $i % 2 ? 10000 : 0;
            $finalAmount = $totalAmount - $discountAmount;
            
            // Create transaction with correct column names based on migration
            $transactionData = [
                'transaction_code' => 'TRX' . $transactionDate->format('Ymd') . str_pad($i, 4, '0', STR_PAD_LEFT),
                'user_id' => $user->user_id,
                'total_amount' => $totalAmount,
                'tax_amount' => $totalAmount * 0.1, // 10% tax
                'discount_amount' => $discountAmount,
                'final_amount' => $finalAmount + ($totalAmount * 0.1), // include tax
                'status' => $i == 1 ? 'pending' : 'paid',
                'payment_status' => $i == 1 ? 'unpaid' : 'paid',
                'payment_method' => ['cash', 'credit_card', 'bank_transfer', 'e_wallet'][rand(0, 3)],
                'customer_name' => 'Customer ' . $i,
                'customer_phone' => '08123456789' . $i,
                'customer_address' => 'Alamat Customer ' . $i,
                'notes' => 'Transaksi contoh ' . $i,
                'admin_notes' => 'Catatan admin untuk transaksi ' . $i,
                'transaction_date' => $transactionDate,
                'created_at' => $transactionDate,
                'updated_at' => $transactionDate,
            ];

            try {
                $transaction = TransactionSales::create($transactionData);
                $this->command->info('Created transaction: ' . $transaction->transaction_code . ' (ID: ' . $transaction->id . ')');
                
                // Create sample detail if products exist
                if ($products->count() > 0) {
                    $product = $products->random(); // Get random product
                    $quantity = rand(1, 3);
                    
                    // Check if TransactionSalesDetail has correct columns
                    try {
                        TransactionSalesDetail::create([
                            'transaction_sales_id' => $transaction->id, // Use id instead of transaction_sales_id
                            'product_id' => $product->item_id,
                            'product_name' => $product->name_item,
                            'product_price' => $product->sell_price,
                            'quantity' => $quantity,
                            'subtotal' => $product->sell_price * $quantity,
                            'notes' => 'Detail produk ' . $product->name_item,
                        ]);
                        $this->command->info('Created transaction detail for: ' . $product->name_item);
                    } catch (\Exception $e) {
                        $this->command->warn('Could not create transaction detail: ' . $e->getMessage());
                    }
                }
                
            } catch (\Exception $e) {
                $this->command->error('Error creating transaction ' . $i . ': ' . $e->getMessage());
            }
        }

        $this->command->info('TransactionSales seeder completed!');
    }
}
