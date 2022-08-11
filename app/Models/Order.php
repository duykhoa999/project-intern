<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
        'id_pd', 'ngay_dat', 'ho_ten_nn', 'dia_chi_nn', 'sdt_nn', 'ngay_giao','ghi_chu','trang_thai','kich_hoat','hinh_thuc_thanh_toan','ma_kh','ma_nv'
    ];
    protected $primaryKey = 'id_pd';
    protected $table = 'phieu_dat';

    public function order_details() {
        return $this->belongsTo(OrderDetail::class, 'id_pd', 'id_pd');
    }
    public function bills()
    {
        return $this->hasOne(Bill::class, 'id_pd', 'id_pd');
    }
    public function getDataIndex($key_search,$arr)
    {
        $query = $this->query();
        if(!is_null($key_search) && strlen($key_search) > 0)
        {
            $query->where(function($query) use ($key_search){
                $query->orWhere('ho_ten_nn', 'like', '%'.$key_search.'%')
                    ->orWhere('trang_thai', 'like', '%'.$key_search.'%');
            });
        }
        if(isset($arr) && $arr !='')
        {
            $query->where(function($query) use ($arr){
                $query->orWhere('trang_thai', '=',$arr);
            });
        }
        try {
            $result = $query->with(['order_details','bills'])->orderBy('id_pd', 'DESC')->paginate(config('define.paginate.list_order_user'));
        } catch (Exception $e) {
            return false;
        }

        return $result;
    }
}
