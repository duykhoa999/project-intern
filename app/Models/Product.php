<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // use HasFactory;
    public $timestamps = false; //set time to false
    protected $fillable = [
        'ma_dr', 'ten_dr', 'slug', 'gia', 'mo_ta', 'noi_dung_dr', 'hinh_anh', 'sl_ton', 'luot_xem', 'ma_lr', 'ma_th', 'ma_ncc'
    ];
    protected $primaryKey = 'ma_dr';
    protected $keyType = 'string';
    protected $table = 'dong_ruou';
    public function loai_ruou()
    {
        return $this->belongsTo(Category::class, 'ma_lr', 'ma_lr');
    }
    public function thuong_hieu()
    {
        return $this->belongsTo(Trademark::class, 'ma_th', 'ma_th');
    }
    public function nha_cc()
    {
        return $this->belongsTo(Manufacture::class, 'ma_ncc', 'ma_ncc');
    }
    public function coupon_details() {
        return $this->belongsTo(Coupon_details::class, 'ma_dr', 'ma_dr');
    }
    // public function coupons() {
    //     return $this->belongsToMany(Coupon::class,'chi_tiet_km', 'ma_km', 'ma_dr')->withPivot('ma_km');
    // }
    public function order_details()
    {
        return $this->belongsTo(OrderDetail::class,'ma_dr','ma_dr');
    }
    public function getDataIndex($key_search,$arr)
    {
        $query = $this->query();
        if(!is_null($key_search) && strlen($key_search) > 0)
        {
            $query->where(function($query) use ($key_search){
                $query->where('ten_dr', 'like', '%'.$key_search.'%');
            });
        }

        try {//'cart_details',
            $result = $query->with(['thuong_hieu','loai_ruou','nha_cc'])->orderBy('ma_dr', 'DESC')->paginate(config('define.paginate.manufactures_index'));
        } catch (Exception $e) {
            return false;
        }

        return $result;
    }
}
