<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $table = 'transactions';
    protected $guarded = ['created_at','updated_at'];

    public function detailTransaksi() {
        return $this->hasMany(DetailTransaction::class, 'transaksi_id');
    }
}
