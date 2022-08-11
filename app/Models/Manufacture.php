<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manufacture extends Model
{
    public $timestamps = false; //set time to false
    protected $fillable = [
        'ma_ncc', 'ten_ncc', 'dia_chi', 'email'
    ];
    protected $primaryKey = 'ma_ncc';
    protected $keyType = 'string';
    protected $table = 'nha_cc';
    public function __construct()
    {
        parent::__construct();
    }
    public function products() {
        return $this->hasMany(Product::class, 'ma_ncc', 'ma_ncc');
    }
    public function getDataIndex($key_search)
    {
        $query = $this->query();
        if(!is_null($key_search) && strlen($key_search) > 0)
        {
            $query->where(function($query) use ($key_search){
                $query->orWhere('ten_ncc', 'like', '%'.$key_search.'%')
                      ->orWhere('email', 'like', '%'.$key_search.'%');
            });
        }

        try {
            $result = $query->orderBy('ma_ncc', 'DESC')->paginate(config('define.paginate.manufactures_index'));
        } catch (Exception $e) {
            return false;
        }

        return $result;
    }
}
