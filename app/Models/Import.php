<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Import extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
        'ma_pn', 'ngay_tao_pn', 'ma_nv', 'ma_ddh'
    ];
    protected $primaryKey = 'ma_pn';
    protected $table = 'phieu_nhap';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The data type of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    public function import_details() {
        return $this->hasMany(ImportDetail::class, 'ma_pn', 'ma_pn');
    }
    public function order()
    {
        return $this->hasOne(CompanyOrder::class, 'ma_ddh', 'ma_ddh');
    }
    public function staff()
    {
        return $this->hasOne(User::class, 'ma_nv', 'ma_nv');
    }
    // public function getDataIndex($key_search,$arr)
    // {
    //     $query = $this->query();
    //     if(!is_null($key_search) && strlen($key_search) > 0)
    //     {
    //         $query->where(function($query) use ($key_search){
    //             $query->orWhere('ho_ten_nn', 'like', '%'.$key_search.'%')
    //                 ->orWhere('trang_thai', 'like', '%'.$key_search.'%');
    //         });
    //     }
    //     if(isset($arr) && $arr !='')
    //     {
    //         $query->where(function($query) use ($arr){
    //             $query->orWhere('trang_thai', '=',$arr);
    //         });
    //     }
    //     try {
    //         $result = $query->with(['order_details','bills'])->orderBy('id_pd', 'DESC')->paginate(config('define.paginate.list_order_user'));
    //     } catch (Exception $e) {
    //         return false;
    //     }

    //     return $result;
    // }
}
