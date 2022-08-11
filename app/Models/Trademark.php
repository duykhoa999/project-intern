<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trademark extends Model
{
    protected $fillable = [
        'ma_th',
        'ten_th',
        'slug',
        'hinh_anh',
        'mo_ta'
    ];

    protected $primaryKey = 'ma_th';
    protected $keyType = 'string';
    public $timestamps = false;
    protected $table = 'thuong_hieu';

    public function __construct()
    {
        parent::__construct();
    }

    public function products() {
        return $this->hasMany(Product::class, 'ma_th', 'ma_th');
    }
    public function getDataIndex($key_search)
    {
        $query = $this->query();
        if(!is_null($key_search) && strlen($key_search) > 0)
        {
            $query->where(function($query) use ($key_search){
                $query->orWhere('ten_th', 'like', '%'.$key_search.'%')
                      ->orWhere('mo_ta', 'like', '%'.$key_search.'%');
            });
        }

        try {
            $result = $query->orderBy('ma_th', 'DESC')->paginate(config('define.paginate.manufactures_index'));
        } catch (Exception $e) {
            return false;
        }

        return $result;
    }
}
