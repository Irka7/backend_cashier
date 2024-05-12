<?php

namespace App\Imports;

use App\Models\Menu;
use App\Models\Kategori;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\PersistRelations;

class MenuImport implements ToModel, WithHeadingRow, PersistRelations
{
    private $kategoris;

    public function __construct()
    {
        $this->kategoris = Kategori::select('id', 'name')->get();
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $kategori = $this->kategoris->where('name', $row['kategori'])->first();

        return new Menu([
            'menu_name' => $row['nama_menu'],
            'kategori_id' => $kategori->id ?? NULL,
            'price' => $row['harga'],
            'image' => $row['gambar'] ?? null,
            'description' => $row['deskripsi']
        ]);
    }
}
