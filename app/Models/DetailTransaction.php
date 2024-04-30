<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailTransaction extends Model
{
    use HasFactory;

    protected $table = 'detail_transactions';
    protected $guarded = ['id'];

    public function transaksi() {
        return $this->belongsTo(Transaction::class, 'transaksi_id');
    }

    public function menu() {
        return $this->hasOne(Menu::class, 'id', 'menu_id');
    }
}
