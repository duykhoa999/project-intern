<?php
namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;

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
}