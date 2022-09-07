<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CompanyOrder extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
        'ma_ddh', 'ngaydat', 'ma_ncc', 'ma_nv'
    ];
    protected $primaryKey = 'ma_ddh';
    protected $table = 'don_dh';

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

    public function order_details() {
        return $this->hasMany(CompanyOrderDetail::class, 'ma_ddh', 'ma_ddh');
    }
    public function manufacture()
    {
        return $this->hasOne(Manufacture::class, 'ma_ncc', 'ma_ncc');
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
