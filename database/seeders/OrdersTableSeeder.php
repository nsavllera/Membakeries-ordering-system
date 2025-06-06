<?php

namespace Database\Seeders;

use App\Models\Orders;
use App\Models\User;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    public function run()
    {
        $users = User::all();

        foreach ($users as $user) {
            Orders::factory()->count(3)->create([
                'user_id' => $user->id,
            ]);
        }
    }
}

