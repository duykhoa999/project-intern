<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyOrderDetail extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
        'ma_ddh', 'ma_dr', 'so_luong', 'gia'
    ];
    protected $primaryKey = 'ma_ddh';
    // protected $keyType = ['integer','string'];
    protected $table = 'chi_tiet_ddh';
    public function products()
    {
        return $this->hasMany(Product::class, 'ma_dr', 'ma_dr');
    }
    public function company_order()
    {
        return $this->hasMany(CompanyOrder::class, 'ma_ddh', 'ma_ddh');
    }
}
