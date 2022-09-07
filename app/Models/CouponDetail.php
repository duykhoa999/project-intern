<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouponDetail extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
        'ma_km', 'ma_dr', 'phantram_km'
    ];
    protected $primaryKey = 'ma_km';
    protected $keyType = 'string';
    protected $table = 'chi_tiet_km';

    public function products()
    {
        return $this->belongsTo(Product::class, 'ma_dr', 'ma_dr');
    }
    public function coupons()
    {
        return $this->belongsTo(Coupon::class, 'ma_km', 'ma_km');
    }
}
