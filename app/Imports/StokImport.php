<?php

namespace App\Imports;

use App\Models\Menu;
use App\Models\Stock;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\PersistRelations;

class StokImport implements ToModel, WithHeadingRow, PersistRelations
{
    private $menus;

    public function __construct()
    {
        $this->menus = Menu::select('id', 'menu_name')->get();
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $menu = $this->menus->where('menu_name', $row['nama_menu'])->first();

        return new Stock([
            'menu_id' => $menu->id ?? NULL,
            'stock' => $row['stok']
        ]);
    }

    // public function headingRow() : int
    // {
    //     return 1;
    // }
}
