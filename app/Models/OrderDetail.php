<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
        'id_pd', 'ma_dr', 'so_luong', 'gia'
    ];
    protected $primaryKey = 'id_pd';
    // protected $keyType = ['integer','string'];
    protected $table = 'chi_tiet_pd';
    public function products()
    {
        return $this->hasMany(Product::class, 'ma_dr', 'ma_dr');
    }
    public function order()
    {
        return $this->hasMany(Order::class, 'id_pd', 'id_pd');
    }
    public function bills()
    {
        return $this->hasMany(Bill::class, 'id_pd', 'id_pd');
    }
}
