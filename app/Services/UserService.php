<?php
namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use Exception;

class UserService
{
    protected $userModel;

    public function __construct(User $userModel)
    {
        $this->userModel = $userModel;
    }

    public function getByMail($email)
    {
        if(strlen($email) <= 0)
            return false;

        $filter['email'] = $email;

        return $this->userModel->getByArrayFilter($filter);
    }

    public function create($data)
    {
        $user = new User();
        $user->ma_nv         = $data['ma_nv'] ?? '';
        $user->ho_ten       = $data['ho_ten'] ?? '';
        $user->phai         = $data['phai'] ?? 0;
        $user->ngay_sinh         = $data['ngay_sinh'] ?? '';
        $user->dia_chi         = $data['dia_chi'] ?? '';
        $user->sdt         = $data['sdt'] ?? '';
        $user->email         = $data['email'] ?? '';
        $user->password         = isset($data['password']) ? Hash::make($data['password']) : Hash::make('123456789');
        $user->ma_q         = 'AD';
        try {
            $user->save();
        } catch (Exception $e) {
            return false;
        }
        return $user;
    }

    public function update($user, $data)
    {
        $user->ho_ten       = $data['ho_ten'] ?? '';
        $user->phai         = $data['phai'] ?? 0;
        $user->ngay_sinh         = $data['ngay_sinh'] ?? '';
        $user->dia_chi         = $data['dia_chi'] ?? '';
        $user->sdt         = $data['sdt'] ?? '';
        $user->email         = $data['email'] ?? '';
        if(isset($data['password']))
        {
            $user->password = Hash::make($data['password']);
        }
        $user->ma_q         = 'AD';
        try {
            $user->save();
        } catch (Exception $e) {
            return false;
        }
        return $user;
    }

    public function getDataIndex($key_search = null)
    {
        return $this->userModel->getDataIndex($key_search);
    }
}