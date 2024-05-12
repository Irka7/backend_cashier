<?php

namespace App\Imports;

use App\Models\Customer;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PelangganImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Customer([
            'name' => $row['nama_pelanggan'],
            'email' => $row['email'],
            'no_tlp' => $row['no_telepon']
        ]);
    }

    public function headingRow() : int
    {
        return 1;
    }
}
