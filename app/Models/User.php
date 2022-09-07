<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'ma_nv';

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
    protected $table = 'nhan_vien';
    public $timestamps = false; //set time to false

	public function getByArrayFilter($filter)
	{
		return $this->query()->where($filter)->first();
	}

    public function getDataIndex($key_search)
    {
        $query = $this->query();
        $query->where('ma_nv', '<>', 'NV001');
        if(!is_null($key_search) && strlen($key_search) > 0)
        {
            $query->where(function($query) use ($key_search){
                $query->orWhere('ho_ten', 'like', '%'.$key_search.'%');
            });
        }

        try {
            $result = $query->orderBy('ma_nv', 'DESC')->paginate(config('define.paginate.user_index'));
        } catch (\Exception $e) {
            return false;
        }

        return $result;
    }
}
