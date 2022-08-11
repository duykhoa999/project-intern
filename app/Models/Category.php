<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'ma_lr',
        'ten_lr',
        'slug'
    ];

    protected $primaryKey = 'ma_lr';
    protected $keyType = 'string';
    public $timestamps = false;
    protected $table = 'loai_ruou';

    public function __construct()
    {
        parent::__construct();
    }

    public function products() {
        return $this->hasMany(Product::class, 'ma_lr', 'ma_lr');
    }
    public function getDataIndex($key_search)
    {
        $query = $this->query();
        if(!is_null($key_search) && strlen($key_search) > 0)
        {
            $query->where(function($query) use ($key_search){
                $query->orWhere('ten_lr', 'like', '%'.$key_search.'%');
            });
        }

        try {
            $result = $query->orderBy('ma_lr', 'DESC')->paginate(config('define.paginate.manufactures_index'));
        } catch (Exception $e) {
            return false;
        }

        return $result;
    }
}
