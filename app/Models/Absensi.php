<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    const SAKIT = 'sakit';
    const MASUK = 'masuk';
    const CUTI = 'cuti';

    public static function getStatusOptions()
    {
        return [
            self::SAKIT,
            self::MASUK,
            self::CUTI,
        ];
    }

    protected $table = 'absensis';
    protected $guarded = ['id'];
    // protected $attributes = ['status' => 'Masuk'];
}
