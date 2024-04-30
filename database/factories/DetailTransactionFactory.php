<?php

namespace Database\Factories;

use App\Models\Menu;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\DetailTransaction>
 */
class DetailTransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $transaksi_id = fake()->randomElement(Transaction::select("id")->get());
        $menu_id = fake()->randomElement(Menu::select("id")->get());
        $jumlah = fake()->numberBetween(1, 5);
        $subtotal = fake()->numberBetween(1, 100). "000" * $jumlah;
        return [
            'transaksi_id' => $transaksi_id,
            'menu_id' => $menu_id,
            'jumlah' => $jumlah,
            'subtotal' => $subtotal
        ];
    }
}
