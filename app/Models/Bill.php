<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
        'ma_hd', 'ngay', 'tong_tien', 'id_pd', 'ma_nv', 'trang_thai_xoa'
    ];
    protected $primaryKey = 'ma_hd';
    protected $keyType = 'string';
    protected $table = 'hoa_don';
    public function order_detail() {
        return $this->belongsTo(OrderDetail::class, 'id_pd', 'id_pd');
    }
}
