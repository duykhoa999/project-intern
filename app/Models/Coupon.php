<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
        'ma_km', 'ten_km', 'ngay_bd', 'ngay_kt', 'mo_ta', 'ma_nv'
    ];
    protected $primaryKey = 'ma_km';
    protected $keyType = 'string';
    protected $table = 'khuyen_mai';
    // public function products() {
    //     return $this->belongsToMany(Products::class,'chi_tiet_km', 'ma_km', 'ma_dr')->withPivot('ma_dr');
    // }
    public function coupon_details() {
        return $this->hasMany(CouponDetail::class, 'ma_km', 'ma_km');
    }

    public function getDataIndex($key_search)
    {
        $query = $this->query();
        if(!is_null($key_search) && strlen($key_search) > 0)
        {
            $query->where(function($query) use ($key_search){
                $query->orWhere('ma_km', 'like', '%'.$key_search.'%');
                $query->orWhere('ten_km', 'like', '%'.$key_search.'%');
                $query->orWhere('mo_ta', 'like', '%'.$key_search.'%');
            });
        }

        try {
            $result = $query->orderBy('ngay_bd', 'DESC')->paginate(config('define.paginate.manufactures_index'));
        } catch (Exception $e) {
            return false;
        }

        return $result;
    }
}
