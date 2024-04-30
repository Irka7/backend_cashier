<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Transaction>
 */
class TransactionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $bulan = fake()->numberBetween(1, 4);
        $tanggal = fake()->numberBetween(1, 29);

        $notrans = '2024' . sprintf('%02d', $bulan) . sprintf('%02d', $tanggal) . sprintf('%04d', fake()->unique()->numberBetween(1, 100));
        $tglTransaksi = '2024-' . sprintf('%02d', $bulan) . '-' . sprintf('%02d', $tanggal);
        $totalHarga = fake()->numberBetween(1, 100). "000";
        $pembayaran = fake()->randomElement(['Cash', 'Debit', 'Kredit']);
        return [
            'id' => $notrans,
            'tanggal' => $tglTransaksi,
            'total_harga' => $totalHarga,
            'pembayaran' => $pembayaran,
            'keterangan' => null,
        ];
    }
}
