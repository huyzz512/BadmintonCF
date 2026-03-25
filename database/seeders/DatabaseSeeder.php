<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RevenueSeeder extends Seeder
{
    public function run()
    {
        $userIds = User::where('role', 'customer')->pluck('id')->toArray();
        $products = Product::all();

        if (empty($userIds) || $products->isEmpty()) {
            $this->command->error("Phải có ít nhất 1 khách và 1 sản phẩm mới seed được!");
            return;
        }


        for ($i = 10; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            
            $orderCount = rand(2, 5);

            for ($j = 0; $j < $orderCount; $j++) {
                $totalAmount = 0;
                $orderItems = [];
                foreach ($products->random(rand(1, 3)) as $product) {
                    $qty = rand(1, 2);
                    $price = $product->price;
                    $totalAmount += ($price * $qty);

                    $orderItems[] = [
                        'product_id' => $product->id,
                        'quantity'   => $qty,
                        'unit_price' => $price,
                    ];
                }

                $order = Order::create([
                    'user_id'          => $userIds[array_rand($userIds)],
                    'total_amount'     => $totalAmount,
                    'shipping_address' => 'Địa chỉ giả lập số ' . rand(1, 100),
                    'phone'            => '09' . rand(10000000, 99999999),
                    'status'           => 'completed', 
                    'payment_method'   => 'COD',
                    'created_at'       => $date->addMinutes(rand(1, 1440)), 
                ]);

                foreach ($orderItems as $item) {
                    $item['order_id'] = $order->id;
                    OrderItem::create($item);
                }
            }
        }

        $this->command->info("Đã bơm dữ liệu thành công.");
    }
}