<?php

namespace App\Exports;

use App\Models\Menu;
use Maatwebsite\Excel\Sheet;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\BeforeExport;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class MenuExport implements FromCollection, WithHeadings, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Menu::all();
    }

    public function headings(): array
    {
        return [
            'No.',
            'Nama Menu',
            'Kategori',
            'Harga',
            'Gambar',
            'Deskripsi',
            'Tanggal Input',
            'Tanggal Update'
        ];
    }
}
