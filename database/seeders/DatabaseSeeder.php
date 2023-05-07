<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $items = \App\Models\Item::factory()->count(100)->create();

        \App\Models\Customer::factory()
            ->count(50)
            ->has(\App\Models\Order::factory()->count(2))
            ->create();

        $orders = \App\Models\Order::all();
        $orders->each(function ($order) use ($items) {
            $order->orderDetails()->attach($items->random(rand(1, 5))->pluck('id')->toArray(), [
                'count' => fake()->randomDigitNotNull(),
                'price' => fake()->randomFloat(2, 1, 10),
            ]);
        });
    }
}
