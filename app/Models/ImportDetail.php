<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportDetail extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
        'ma_pn', 'ma_dr', 'so_luong', 'gia'
    ];
    protected $primaryKey = 'ma_pn';
    protected $keyType = 'string';
    protected $table = 'chi_tiet_pn';
    public function products()
    {
        return $this->hasMany(Product::class, 'ma_dr', 'ma_dr');
    }
    public function import()
    {
        return $this->belongsTo(Import::class, 'ma_pn', 'ma_pn');
    }
}
