<?php
namespace App\Services;

use App\Models\Customer;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;

class CustomerService
{
    protected $customerModel;

    public function __construct(Customer $customerModel)
    {
        $this->customerModel = $customerModel;
    }

    public function getByMail($email)
    {
        if(strlen($email) <= 0)
            return false;

        $filter['email'] = $email;

        return $this->customerModel->getByArrayFilter($filter);
    }

    public function getDataIndex($key_search = null)
    {
        return $this->customerModel->getDataIndex($key_search);
    }
}