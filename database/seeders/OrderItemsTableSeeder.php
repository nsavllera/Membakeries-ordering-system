<?php

namespace Database\Seeders;

use App\Models\Orders;
use App\Models\OrderItems;
use App\Models\Item;
use Illuminate\Database\Seeder;

class OrderItemsTableSeeder extends Seeder
{
    public function run()
    {
        $orders = Orders::all();
        $products = Item::all();

        foreach ($orders as $order) {
            $randomProducts = $products->random(rand(1, 4));

            foreach ($randomProducts as $product) {
                $quantity = rand(1, 5);
                $price = $product->price;
                $subtotal = $quantity * $price;

                OrderItems::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $quantity,
                    'price' => $product->price,
                    'subtotal' => $subtotal,
                ]);
            }
        }
    }
}
